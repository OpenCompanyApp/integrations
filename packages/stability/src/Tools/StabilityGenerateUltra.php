<?php

namespace OpenCompany\Integrations\Stability\Tools;

/**
 * Generate images using Stable Image Ultra.
 */
class StabilityGenerateUltra extends StabilityGenerateCore
{
    protected const NAME = 'stability_generate_ultra';
    protected const DESCRIPTION = 'Generate a high-quality image with Stable Image Ultra.';
    protected const OPERATION = [
        'method' => 'POST',
        'path' => '/v2beta/stable-image/generate/ultra',
        'body_params' => ['prompt', 'aspect_ratio', 'negative_prompt', 'seed', 'style_preset', 'output_format'],
        'required' => ['prompt'],
        'accept' => 'image/*',
    ];
}
