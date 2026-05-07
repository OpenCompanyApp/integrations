<?php

namespace OpenCompany\Integrations\Stability\Tools;

/**
 * Fetch the result of an image-to-video job.
 */
class StabilityGetVideoResult extends AbstractStabilityTool
{
    protected const NAME = 'stability_get_video_result';
    protected const DESCRIPTION = 'Fetch the result of an image-to-video generation job.';
    protected const PARAMETERS = [
        'id' => ['type' => 'string', 'required' => true, 'description' => 'Generation id returned by stability_image_to_video.'],
    ];
    protected const OPERATION = [
        'method' => 'GET',
        'path' => '/v2beta/image-to-video/result/{id}',
        'path_params' => ['id'],
        'required' => ['id'],
        'accept' => 'video/*',
    ];
}
