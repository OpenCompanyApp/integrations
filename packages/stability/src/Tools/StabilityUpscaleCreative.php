<?php

namespace OpenCompany\Integrations\Stability\Tools;

/**
 * Upscale an image with creative enhancement.
 */
class StabilityUpscaleCreative extends AbstractStabilityTool
{
    protected const NAME = 'stability_upscale_creative';
    protected const DESCRIPTION = 'Upscale an image with creative enhancement.';
    protected const PARAMETERS = [
        'image' => ['type' => 'string', 'required' => true, 'description' => 'Image bytes or local path to upload.'],
        'prompt' => ['type' => 'string', 'required' => true, 'description' => 'Prompt guiding creative detail.'],
        'negative_prompt' => ['type' => 'string', 'description' => 'Things to avoid.'],
        'seed' => ['type' => 'integer', 'description' => 'Optional deterministic seed.'],
        'output_format' => ['type' => 'string', 'description' => 'Output image format.'],
    ];
    protected const OPERATION = [
        'method' => 'POST',
        'path' => '/v2beta/stable-image/upscale/creative',
        'file_params' => ['image'],
        'body_params' => ['prompt', 'negative_prompt', 'seed', 'output_format'],
        'required' => ['image', 'prompt'],
        'accept' => 'image/*',
    ];
}
