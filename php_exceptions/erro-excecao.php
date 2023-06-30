<?php
class MinhaExcecao extends DomainException
{
    public function exibeName()
    {
        echo "Vinícius";
    }
}

try{
    throw new MinhaExcecao();
}catch (MinhaExcecao $e){
    $e->exibeName();
}