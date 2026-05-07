<?php

namespace OpenCompany\Integrations\YouTube\Tools;

/**
 * Super Chat Events List.
 *
 * Maps to the official YouTube Data API endpoint GET /youtube/v3/superChatEvents.
 */
class YouTubeSuperChatEventsList extends AbstractYouTubeTool
{
    protected const NAME = 'youtube_super_chat_events_list';
    protected const DESCRIPTION = 'Super Chat Events List

Official YouTube Data API endpoint: GET /youtube/v3/superChatEvents
Retrieves a list of resources, possibly filtered.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official YouTube method. Known keys: pageToken, part, hl, maxResults.',
  ),
  'pageToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'The *pageToken* parameter identifies a specific page in the result set that should be returned. In an API response, the nextPageToken and prevPageToken properties identify other pages that could be retrieved.',
  ),
  'part' =>
  array (
    'type' => 'array',
    'required' => true,
    'description' => 'The *part* parameter specifies the superChatEvent resource parts that the API response will include. This parameter is currently not supported.',
    'items' =>
    array (
      'type' => 'string',
    ),
  ),
  'hl' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Return rendered funding amounts in specified language.',
  ),
  'maxResults' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'The *maxResults* parameter specifies the maximum number of items that should be returned in the result set.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/youtube/v3/superChatEvents';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'pageToken',
  1 => 'part',
  2 => 'hl',
  3 => 'maxResults',
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}
