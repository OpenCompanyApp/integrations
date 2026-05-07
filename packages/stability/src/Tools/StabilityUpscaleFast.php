<?php

namespace OpenCompany\Integrations\Stability\Tools;

/**
 * Quickly upscale an input image.
 */
class StabilityUpscaleFast extends AbstractStabilityTool
{
    protected const NAME = 'stability_upscale_fast';
    protected const DESCRIPTION = 'Quickly upscale an image.';
    protected const PARAMETERS = [
        'image' => ['type' => 'string', 'required' => true, 'description' => 'Image bytes or local path to upload.'],
        'output_format' => ['type' => 'string', 'description' => 'Output image format.'],
    ];
    protected const OPERATION = [
        'method' => 'POST',
        'path' => '/v2beta/stable-image/upscale/fast',
        'file_params' => ['image'],
        'body_params' => ['output_format'],
        'required' => ['image'],
        'accept' => 'image/*',
    ];
}
