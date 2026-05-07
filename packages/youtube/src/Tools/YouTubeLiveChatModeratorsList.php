<?php

namespace OpenCompany\Integrations\YouTube\Tools;

/**
 * Live Chat Moderators List.
 *
 * Maps to the official YouTube Data API endpoint GET /youtube/v3/liveChat/moderators.
 */
class YouTubeLiveChatModeratorsList extends AbstractYouTubeTool
{
    protected const NAME = 'youtube_live_chat_moderators_list';
    protected const DESCRIPTION = 'Live Chat Moderators List

Official YouTube Data API endpoint: GET /youtube/v3/liveChat/moderators
Retrieves a list of resources, possibly filtered.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official YouTube method. Known keys: pageToken, part, maxResults, liveChatId.',
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
    'description' => 'The *part* parameter specifies the liveChatModerator resource parts that the API response will include. Supported values are id and snippet.',
    'items' =>
    array (
      'type' => 'string',
    ),
  ),
  'maxResults' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'The *maxResults* parameter specifies the maximum number of items that should be returned in the result set.',
  ),
  'liveChatId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'The id of the live chat for which moderators should be returned.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/youtube/v3/liveChat/moderators';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'pageToken',
  1 => 'part',
  2 => 'maxResults',
  3 => 'liveChatId',
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}
