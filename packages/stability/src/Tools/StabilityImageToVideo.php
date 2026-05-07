<?php

namespace OpenCompany\Integrations\Stability\Tools;

/**
 * Start an image-to-video generation job.
 */
class StabilityImageToVideo extends AbstractStabilityTool
{
    protected const NAME = 'stability_image_to_video';
    protected const DESCRIPTION = 'Start an image-to-video generation job.';
    protected const PARAMETERS = [
        'image' => ['type' => 'string', 'required' => true, 'description' => 'Image bytes or local path to animate.'],
        'seed' => ['type' => 'integer', 'description' => 'Optional deterministic seed.'],
        'cfg_scale' => ['type' => 'number', 'description' => 'How strongly generation follows the input image.'],
        'motion_bucket_id' => ['type' => 'integer', 'description' => 'Motion intensity bucket.'],
    ];
    protected const OPERATION = [
        'method' => 'POST',
        'path' => '/v2beta/image-to-video',
        'file_params' => ['image'],
        'body_params' => ['seed', 'cfg_scale', 'motion_bucket_id'],
        'required' => ['image'],
    ];
}
