<?php
function geraEmail(string $assinatura): void
{
    $message = <<<FINAL
        Olá, Usuário(a)
        
        Estamos aqui pelo motivo que: {motivo}
        
        {$assinatura};
    FINAL;
    echo $message;

}
geraEmail('vvebaldo');
