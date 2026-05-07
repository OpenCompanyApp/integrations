<?php

namespace OpenCompany\Integrations\GoogleChat\Tools;

/**
 * Users Sections Position.
 *
 * Maps to the official Google Chat endpoint POST /v1/{+name}:position.
 */
class GoogleChatUsersSectionsPosition extends AbstractGoogleChatTool
{
    protected const NAME = 'google_chat_users_sections_position';
    protected const DESCRIPTION = 'Users Sections Position

Official Google Chat endpoint: POST /v1/{+name}:position
Changes the sort order of a section. For details, see [Create and organize sections in Google Chat](https://support.google.com/chat/answer/16059854). Requires [user authentication](https://developers.google.com/workspace/chat/authenticate-authorize-chat-user) with the [authorization scope](https://developers.google.com/workspace/chat/authenticate-authorize#chat-api-scopes): - `https://www.googleapis.com/auth/chat.users.sections`';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `name` from the official Google Chat API method.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Google Chat API `PositionSectionRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/{+name}:position';
    protected const PATH_PARAMS = array (
  0 => 'name',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'name',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}
