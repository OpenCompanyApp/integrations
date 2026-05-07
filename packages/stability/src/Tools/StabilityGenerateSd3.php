<?php

namespace OpenCompany\Integrations\Stability\Tools;

/**
 * Generate images with Stable Diffusion 3 or 3.5 models.
 */
class StabilityGenerateSd3 extends StabilityGenerateCore
{
    protected const NAME = 'stability_generate_sd3';
    protected const DESCRIPTION = 'Generate an image with Stable Diffusion 3 or 3.5 models.';
    protected const PARAMETERS = [
        'prompt' => ['type' => 'string', 'required' => true, 'description' => 'Text prompt describing the desired image.'],
        'model' => ['type' => 'string', 'description' => 'Model identifier such as sd3.5-large, sd3.5-large-turbo, or sd3.5-medium.'],
        'aspect_ratio' => ['type' => 'string', 'description' => 'Output aspect ratio such as 1:1, 16:9, 9:16, 4:5, or 5:4.'],
        'negative_prompt' => ['type' => 'string', 'description' => 'Things to avoid in the generated image.'],
        'seed' => ['type' => 'integer', 'description' => 'Optional deterministic seed.'],
        'output_format' => ['type' => 'string', 'description' => 'Output image format, usually png, jpeg, or webp.'],
    ];
    protected const OPERATION = [
        'method' => 'POST',
        'path' => '/v2beta/stable-image/generate/sd3',
        'body_params' => ['prompt', 'model', 'aspect_ratio', 'negative_prompt', 'seed', 'output_format'],
        'required' => ['prompt'],
        'accept' => 'image/*',
    ];
}
