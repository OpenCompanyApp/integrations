<?php

namespace OpenCompany\Integrations\Stability\Tools;

/**
 * Fill or replace masked regions in an image.
 */
class StabilityInpaint extends AbstractStabilityTool
{
    protected const NAME = 'stability_inpaint';
    protected const DESCRIPTION = 'Fill or replace masked areas of an image.';
    protected const PARAMETERS = [
        'image' => ['type' => 'string', 'required' => true, 'description' => 'Image bytes or local path to upload.'],
        'prompt' => ['type' => 'string', 'required' => true, 'description' => 'Prompt for the replacement content.'],
        'mask' => ['type' => 'string', 'description' => 'Optional mask bytes or local path.'],
        'negative_prompt' => ['type' => 'string', 'description' => 'Things to avoid.'],
        'seed' => ['type' => 'integer', 'description' => 'Optional deterministic seed.'],
        'output_format' => ['type' => 'string', 'description' => 'Output image format.'],
    ];
    protected const OPERATION = [
        'method' => 'POST',
        'path' => '/v2beta/stable-image/edit/inpaint',
        'file_params' => ['image', 'mask'],
        'body_params' => ['prompt', 'negative_prompt', 'seed', 'output_format'],
        'required' => ['image', 'prompt'],
        'accept' => 'image/*',
    ];
}
