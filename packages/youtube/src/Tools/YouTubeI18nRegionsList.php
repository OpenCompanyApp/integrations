<?php

namespace OpenCompany\Integrations\YouTube\Tools;

/**
 * I18n Regions List.
 *
 * Maps to the official YouTube Data API endpoint GET /youtube/v3/i18nRegions.
 */
class YouTubeI18nRegionsList extends AbstractYouTubeTool
{
    protected const NAME = 'youtube_i18n_regions_list';
    protected const DESCRIPTION = 'I18n Regions List

Official YouTube Data API endpoint: GET /youtube/v3/i18nRegions
Retrieves a list of resources, possibly filtered.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official YouTube method. Known keys: hl, part.',
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
    'description' => 'The *part* parameter specifies the i18nRegion resource properties that the API response will include. Set the parameter value to snippet.',
    'items' =>
    array (
      'type' => 'string',
    ),
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/youtube/v3/i18nRegions';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'hl',
  1 => 'part',
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}
