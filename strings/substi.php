<?php
    $text = "Lorem caralho dolor sit amet, consectetur adipiscing porra. Phasellus vehicula pulvinar velit, in morte risus tempus at.";
    $palavrao = ["porra", "caralho", "morte"];
    echo str_replace($palavrao, "****", $text).PHP_EOL;
    echo strtr($text, [$palavrao => "****"]);
