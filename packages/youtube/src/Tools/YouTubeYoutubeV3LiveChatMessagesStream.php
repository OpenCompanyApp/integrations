<?php

namespace OpenCompany\Integrations\YouTube\Tools;

/**
 * Youtube V3 Live Chat Messages Stream.
 *
 * Maps to the official YouTube Data API endpoint GET /youtube/v3/liveChat/messages/stream.
 */
class YouTubeYoutubeV3LiveChatMessagesStream extends AbstractYouTubeTool
{
    protected const NAME = 'youtube_youtube_v3_live_chat_messages_stream';
    protected const DESCRIPTION = 'Youtube V3 Live Chat Messages Stream

Official YouTube Data API endpoint: GET /youtube/v3/liveChat/messages/stream
Allows a user to load live chat through a server-streamed RPC.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official YouTube method. Known keys: maxResults, pageToken, hl, profileImageSize, part, liveChatId.',
  ),
  'maxResults' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'The *maxResults* parameter specifies the maximum number of items that should be returned in the result set. Not used in the streaming RPC.',
  ),
  'pageToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'The *pageToken* parameter identifies a specific page in the result set that should be returned. In an API response, the nextPageToken property identify other pages that could be retrieved.',
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
  'part' =>
  array (
    'type' => 'array',
    'required' => false,
    'description' => 'The *part* parameter specifies the liveChatComment resource parts that the API response will include. Supported values are id, snippet, and authorDetails.',
    'items' =>
    array (
      'type' => 'string',
    ),
  ),
  'liveChatId' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'The id of the live chat for which comments should be returned.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/youtube/v3/liveChat/messages/stream';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'maxResults',
  1 => 'pageToken',
  2 => 'hl',
  3 => 'profileImageSize',
  4 => 'part',
  5 => 'liveChatId',
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}
