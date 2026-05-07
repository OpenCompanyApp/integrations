<?php

namespace OpenCompany\Integrations\YouTube\Tools;

/**
 * Live Chat Moderators Insert.
 *
 * Maps to the official YouTube Data API endpoint POST /youtube/v3/liveChat/moderators.
 */
class YouTubeLiveChatModeratorsInsert extends AbstractYouTubeTool
{
    protected const NAME = 'youtube_live_chat_moderators_insert';
    protected const DESCRIPTION = 'Live Chat Moderators Insert

Official YouTube Data API endpoint: POST /youtube/v3/liveChat/moderators
Inserts a new resource into this collection.';
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
    'description' => 'The *part* parameter serves two purposes in this operation. It identifies the properties that the write operation will set as well as the properties that the API response returns. Set the parameter value to snippet.',
    'items' =>
    array (
      'type' => 'string',
    ),
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official YouTube Data API `LiveChatModerator` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/youtube/v3/liveChat/moderators';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'part',
);
    protected const BODY_REQUIRED = true;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}
