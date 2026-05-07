<?php

namespace OpenCompany\Integrations\Stability\Tools;

/**
 * Remove an image background.
 */
class StabilityRemoveBackground extends AbstractStabilityTool
{
    protected const NAME = 'stability_remove_background';
    protected const DESCRIPTION = 'Remove an image background.';
    protected const PARAMETERS = [
        'image' => ['type' => 'string', 'required' => true, 'description' => 'Image bytes or local path to upload.'],
        'output_format' => ['type' => 'string', 'description' => 'Output image format.'],
    ];
    protected const OPERATION = [
        'method' => 'POST',
        'path' => '/v2beta/stable-image/edit/remove-background',
        'file_params' => ['image'],
        'body_params' => ['output_format'],
        'required' => ['image'],
        'accept' => 'image/*',
    ];
}
