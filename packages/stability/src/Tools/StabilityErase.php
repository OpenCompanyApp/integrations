<?php

namespace OpenCompany\Integrations\Stability\Tools;

/**
 * Remove masked regions from an image.
 */
class StabilityErase extends AbstractStabilityTool
{
    protected const NAME = 'stability_erase';
    protected const DESCRIPTION = 'Remove masked areas from an image.';
    protected const PARAMETERS = [
        'image' => ['type' => 'string', 'required' => true, 'description' => 'Image bytes or local path to upload.'],
        'mask' => ['type' => 'string', 'required' => true, 'description' => 'Mask bytes or local path.'],
        'output_format' => ['type' => 'string', 'description' => 'Output image format.'],
    ];
    protected const OPERATION = [
        'method' => 'POST',
        'path' => '/v2beta/stable-image/edit/erase',
        'file_params' => ['image', 'mask'],
        'body_params' => ['output_format'],
        'required' => ['image', 'mask'],
        'accept' => 'image/*',
    ];
}
