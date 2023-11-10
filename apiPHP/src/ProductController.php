<?php

namespace src;

class ProductController
{
    public function __construct(private ProductGateway $gateway)
    {

    }

    public function processRequest(string $method, ?string $id): void
    {
        if ($id) {
            $this->processResourceRequest($method, $id);
        } else {
            $this->processCollectionRequest($method);
        }
    }

    private function processResourceRequest(string $method, string $id): void
    {
        $product = $this->gateway->get($id);
        if(!$product){
            http_response_code(404);
            echo json_encode([
                "message"=> "product not found"
            ]);
            return;
        }
        echo match($method){
            'GET' => json_encode($product),
            'PATCH' => $this->patchMethod($product, $id),
            'DELETE' => $this->deleteMethod($id),
            default => (http_response_code(405) AND header("Allow: GET, PATCH, DELETE"))
        };
    }

    private function processCollectionRequest(string $method): void
    {
        $methodCase = match($method){
            'GET' => json_encode([$this->gateway->getAll()]),
            'POST' =>  $this->postMethod(),
            default => (http_response_code(405) AND header("Allow: GET, POST"))
        };
        echo $methodCase;
    }

    private function getValidationErrors(array $data, bool $is_new = true): array
    {
        $errors = [];
        if ($is_new && empty($data['name'])) {
            $errors[] = "name is required";
        }
        if (array_key_exists("size", $data)) {
            if (filter_var($data['size'], FILTER_VALIDATE_INT) === false) {
                $errors[] = "size must be an integer";
            }
        }
        return $errors;
    }

    private function postMethod(): string
    {
        $data = (array)json_decode(file_get_contents("php://input"), true);
        $errors = $this->getValidationErrors($data);
        if (!empty($errors)) {
            http_response_code(422);
            return json_encode(['Errors' => $errors]);
        }
        $id = $this->gateway->create($data);
        http_response_code(201);
        return json_encode([
            "message" => "Product created",
            "id" => $id
        ]);
    }

    private function patchMethod(array $product, int $id): string
    {
        $data = (array)json_decode(file_get_contents("php://input"), true);
        $errors = $this->getValidationErrors($data, false);
        if (!empty($errors)) {
            http_response_code(422);
            return json_encode(['Errors' => $errors]);
        }
        $rows = $this->gateway->update($product, $data);
        return json_encode([
            "message" => "Product $id updated",
            "rows" => $rows
        ]);
    }

    private function deleteMethod(int $id): string
    {
        $rows = $this->gateway->delete($id);
        return json_encode([
            "message" => "Product $id deleted",
            "rows" => $rows
        ]);
    }
}