<?php

namespace OpenCompany\Integrations\GoogleChat\Tools;

/**
 * Users Sections Items Move.
 *
 * Maps to the official Google Chat endpoint POST /v1/{+name}:move.
 */
class GoogleChatUsersSectionsItemsMove extends AbstractGoogleChatTool
{
    protected const NAME = 'google_chat_users_sections_items_move';
    protected const DESCRIPTION = 'Users Sections Items Move

Official Google Chat endpoint: POST /v1/{+name}:move
Moves an item from one section to another. For example, if a section contains spaces, this method can be used to move a space to a different section. For details, see [Create and organize sections in Google Chat](https://support.google.com/chat/answer/16059854). Requires [user authentication](https://developers.google.com/workspace/chat/authenticate-authorize-chat-user) with the [authorization scope](https://developers.google.com/workspace/chat/authenticate-authorize#chat-api-scopes): - `https://www.googleapis.com/auth/chat.users.sections`';
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
    'description' => 'JSON request body matching the official Google Chat API `MoveSectionItemRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/{+name}:move';
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
