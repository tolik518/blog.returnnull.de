<?php

namespace Returnnull;

class UtilityBinaryConverterPage implements Page
{
    public function __construct(
        private UtilityBinaryConverterProjector $utilityBinaryConverterProjector
    ){}

    public function run(): void
    {
        echo $this->utilityBinaryConverterProjector->getHtml();
    }
}