<?php

namespace OpenCompany\Integrations\YouTube\Tools;

/**
 * Videos Rate.
 *
 * Maps to the official YouTube Data API endpoint POST /youtube/v3/videos/rate.
 */
class YouTubeVideosRate extends AbstractYouTubeTool
{
    protected const NAME = 'youtube_videos_rate';
    protected const DESCRIPTION = 'Videos Rate

Official YouTube Data API endpoint: POST /youtube/v3/videos/rate
Adds a like or dislike rating to a video or removes a rating from a video.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official YouTube method. Known keys: rating, id.',
  ),
  'rating' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Shortcut for query parameter `rating`.',
    'enum' =>
    array (
      0 => 'none',
      1 => 'like',
      2 => 'dislike',
    ),
  ),
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Shortcut for query parameter `id`.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/youtube/v3/videos/rate';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'rating',
  1 => 'id',
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}
