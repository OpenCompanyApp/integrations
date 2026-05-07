<?php

namespace OpenCompany\Integrations\YouTube\Tools;

/**
 * Video Categories List.
 *
 * Maps to the official YouTube Data API endpoint GET /youtube/v3/videoCategories.
 */
class YouTubeVideoCategoriesList extends AbstractYouTubeTool
{
    protected const NAME = 'youtube_video_categories_list';
    protected const DESCRIPTION = 'Video Categories List

Official YouTube Data API endpoint: GET /youtube/v3/videoCategories
Retrieves a list of resources, possibly filtered.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official YouTube method. Known keys: hl, part, id, regionCode.',
  ),
  'hl' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `hl`.',
  ),
  'part' =>
  array (
    'type' => 'array',
    'required' => true,
    'description' => 'The *part* parameter specifies the videoCategory resource properties that the API response will include. Set the parameter value to snippet.',
    'items' =>
    array (
      'type' => 'string',
    ),
  ),
  'id' =>
  array (
    'type' => 'array',
    'required' => false,
    'description' => 'Returns the video categories with the given IDs for Stubby or Apiary.',
    'items' =>
    array (
      'type' => 'string',
    ),
  ),
  'regionCode' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `regionCode`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/youtube/v3/videoCategories';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'hl',
  1 => 'part',
  2 => 'id',
  3 => 'regionCode',
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}
