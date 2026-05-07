<?php

namespace OpenCompany\Integrations\YouTube\Tools;

/**
 * Live Chat Messages List.
 *
 * Maps to the official YouTube Data API endpoint GET /youtube/v3/liveChat/messages.
 */
class YouTubeLiveChatMessagesList extends AbstractYouTubeTool
{
    protected const NAME = 'youtube_live_chat_messages_list';
    protected const DESCRIPTION = 'Live Chat Messages List

Official YouTube Data API endpoint: GET /youtube/v3/liveChat/messages
Retrieves a list of resources, possibly filtered.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official YouTube method. Known keys: part, hl, profileImageSize, liveChatId, pageToken, maxResults.',
  ),
  'part' =>
  array (
    'type' => 'array',
    'required' => true,
    'description' => 'The *part* parameter specifies the liveChatComment resource parts that the API response will include. Supported values are id, snippet, and authorDetails.',
    'items' =>
    array (
      'type' => 'string',
    ),
  ),
  'hl' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Specifies the localization language in which the system messages should be returned.',
  ),
  'profileImageSize' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Specifies the size of the profile image that should be returned for each user.',
  ),
  'liveChatId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'The id of the live chat for which comments should be returned.',
  ),
  'pageToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'The *pageToken* parameter identifies a specific page in the result set that should be returned. In an API response, the nextPageToken property identify other pages that could be retrieved.',
  ),
  'maxResults' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'The *maxResults* parameter specifies the maximum number of items that should be returned in the result set. Not used in the streaming RPC.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/youtube/v3/liveChat/messages';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'part',
  1 => 'hl',
  2 => 'profileImageSize',
  3 => 'liveChatId',
  4 => 'pageToken',
  5 => 'maxResults',
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}
