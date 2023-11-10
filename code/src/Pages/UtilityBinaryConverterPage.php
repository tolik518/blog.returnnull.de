<?php

namespace Returnnull;

class UtilityBinaryConverterPage extends BasePage
{
    public function __construct(
        private UtilityBinaryConverterProjector $utilityBinaryConverterProjector
    ){}

    public function run(Request $request): Response
    {
        return new Response(
            $this->utilityBinaryConverterProjector->getHtml()
        );
    }

    public function getSupportedUrlRegexes(): array
    {
        return [
            '|utility/4B5B_to_MLT3_converter|',
            '|utility/Binary_to_MLT3_converter|',
            '|utility/Binary_to_MLT3_online_converter|'
        ];
    }
}