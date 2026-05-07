<?php

namespace OpenCompany\Integrations\YouTube\Tools;

/**
 * Video Trainability Get.
 *
 * Maps to the official YouTube Data API endpoint GET /youtube/v3/videoTrainability.
 */
class YouTubeVideoTrainabilityGet extends AbstractYouTubeTool
{
    protected const NAME = 'youtube_video_trainability_get';
    protected const DESCRIPTION = 'Video Trainability Get

Official YouTube Data API endpoint: GET /youtube/v3/videoTrainability
Returns the trainability status of a video.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official YouTube method. Known keys: id.',
  ),
  'id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'The ID of the video to retrieve.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/youtube/v3/videoTrainability';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'id',
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}
