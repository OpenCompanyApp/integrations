<?php

namespace OpenCompany\Integrations\YouTube\Tools;

/**
 * Live Chat Messages Transition.
 *
 * Maps to the official YouTube Data API endpoint POST /youtube/v3/liveChat/messages/transition.
 */
class YouTubeLiveChatMessagesTransition extends AbstractYouTubeTool
{
    protected const NAME = 'youtube_live_chat_messages_transition';
    protected const DESCRIPTION = 'Live Chat Messages Transition

Official YouTube Data API endpoint: POST /youtube/v3/liveChat/messages/transition
Transition a durable chat event.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official YouTube method. Known keys: id, status.',
  ),
  'id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'The ID that uniquely identify the chat message event to transition.',
  ),
  'status' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'The status to which the chat event is going to transition.',
    'enum' =>
    array (
      0 => 'statusUnspecified',
      1 => 'closed',
    ),
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/youtube/v3/liveChat/messages/transition';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'id',
  1 => 'status',
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}
