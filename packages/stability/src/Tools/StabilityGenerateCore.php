<?php

namespace OpenCompany\Integrations\Stability\Tools;

/**
 * Generate images using Stable Image Core.
 */
class StabilityGenerateCore extends AbstractStabilityTool
{
    protected const NAME = 'stability_generate_core';
    protected const DESCRIPTION = 'Generate an image with Stable Image Core.';
    protected const PARAMETERS = [
        'prompt' => ['type' => 'string', 'required' => true, 'description' => 'Text prompt describing the desired image.'],
        'aspect_ratio' => ['type' => 'string', 'description' => 'Output aspect ratio such as 1:1, 16:9, 9:16, 4:5, or 5:4.'],
        'negative_prompt' => ['type' => 'string', 'description' => 'Things to avoid in the generated image.'],
        'seed' => ['type' => 'integer', 'description' => 'Optional deterministic seed.'],
        'style_preset' => ['type' => 'string', 'description' => 'Optional Stability style preset.'],
        'output_format' => ['type' => 'string', 'description' => 'Output image format, usually png, jpeg, or webp.'],
    ];
    protected const OPERATION = [
        'method' => 'POST',
        'path' => '/v2beta/stable-image/generate/core',
        'body_params' => ['prompt', 'aspect_ratio', 'negative_prompt', 'seed', 'style_preset', 'output_format'],
        'required' => ['prompt'],
        'accept' => 'image/*',
    ];
}
