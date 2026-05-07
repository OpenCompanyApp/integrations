<?php

namespace OpenCompany\Integrations\YouTube\Tools;

/**
 * Live Chat Moderators Delete.
 *
 * Maps to the official YouTube Data API endpoint DELETE /youtube/v3/liveChat/moderators.
 */
class YouTubeLiveChatModeratorsDelete extends AbstractYouTubeTool
{
    protected const NAME = 'youtube_live_chat_moderators_delete';
    protected const DESCRIPTION = 'Live Chat Moderators Delete

Official YouTube Data API endpoint: DELETE /youtube/v3/liveChat/moderators
Deletes a chat moderator.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official YouTube method. Known keys: id.',
  ),
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Shortcut for query parameter `id`.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/youtube/v3/liveChat/moderators';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'id',
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}
