<?php

namespace Alura\Mvc\Entity;

class Video{        
    
    public readonly int $id;
    public readonly string $url;

    public function __construct(
        string $url,
        public readonly string $title,
        private ?string $filePath = null,
    )
    {
        $this->setUrl($url);
    }

    private function setUrl(string $url){
        if (filter_var($url, FILTER_VALIDATE_URL) === false){
            throw new \InvalidArgumentException();
        }
        $this->url = $url;
    }

    public function setId(int $id): void{
        $this->id = $id;
    }

    public function setFilePath(string $filePath):void {
        $this->filePath = $filePath;
    }

    public function getFilePath(): ?string
    {
        return $this->filePath;
    }
}