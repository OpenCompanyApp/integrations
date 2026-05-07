<?php

namespace OpenCompany\Integrations\GoogleChat\Tools;

/**
 * Users Sections Patch.
 *
 * Maps to the official Google Chat endpoint PATCH /v1/{+name}.
 */
class GoogleChatUsersSectionsPatch extends AbstractGoogleChatTool
{
    protected const NAME = 'google_chat_users_sections_patch';
    protected const DESCRIPTION = 'Users Sections Patch

Official Google Chat endpoint: PATCH /v1/{+name}
Updates a section. Only sections of type `CUSTOM_SECTION` can be updated. For details, see [Create and organize sections in Google Chat](https://support.google.com/chat/answer/16059854). Requires [user authentication](https://developers.google.com/workspace/chat/authenticate-authorize-chat-user) with the [authorization scope](https://developers.google.com/workspace/chat/authenticate-authorize#chat-api-scopes): - `https://www.googleapis.com/auth/chat.users.sections`';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `name` from the official Google Chat API method.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Chat method. Known keys: updateMask.',
  ),
  'updateMask' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Required. The mask to specify which fields to update. Currently supported field paths: - `display_name`',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Google Chat API `GoogleChatV1Section` schema.',
  ),
);
    protected const METHOD = 'PATCH';
    protected const PATH = '/v1/{+name}';
    protected const PATH_PARAMS = array (
  0 => 'name',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'name',
);
    protected const QUERY_KEYS = array (
  0 => 'updateMask',
);
    protected const BODY_REQUIRED = true;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}
