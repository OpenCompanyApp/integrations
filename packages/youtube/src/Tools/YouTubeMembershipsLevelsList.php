<?php

namespace OpenCompany\Integrations\YouTube\Tools;

/**
 * Memberships Levels List.
 *
 * Maps to the official YouTube Data API endpoint GET /youtube/v3/membershipsLevels.
 */
class YouTubeMembershipsLevelsList extends AbstractYouTubeTool
{
    protected const NAME = 'youtube_memberships_levels_list';
    protected const DESCRIPTION = 'Memberships Levels List

Official YouTube Data API endpoint: GET /youtube/v3/membershipsLevels
Retrieves a list of all pricing levels offered by a creator to the fans.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official YouTube method. Known keys: part.',
  ),
  'part' =>
  array (
    'type' => 'array',
    'required' => true,
    'description' => 'The *part* parameter specifies the membershipsLevel resource parts that the API response will include. Supported values are id and snippet.',
    'items' =>
    array (
      'type' => 'string',
    ),
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/youtube/v3/membershipsLevels';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'part',
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}
