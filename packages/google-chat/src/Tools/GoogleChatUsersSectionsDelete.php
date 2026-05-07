<?php

namespace OpenCompany\Integrations\GoogleChat\Tools;

/**
 * Users Sections Delete.
 *
 * Maps to the official Google Chat endpoint DELETE /v1/{+name}.
 */
class GoogleChatUsersSectionsDelete extends AbstractGoogleChatTool
{
    protected const NAME = 'google_chat_users_sections_delete';
    protected const DESCRIPTION = 'Users Sections Delete

Official Google Chat endpoint: DELETE /v1/{+name}
Deletes a section of type `CUSTOM_SECTION`. If the section contains items, such as spaces, the items are moved to Google Chat\'s default sections and are not deleted. For details, see [Create and organize sections in Google Chat](https://support.google.com/chat/answer/16059854). Requires [user authentication](https://developers.google.com/workspace/chat/authenticate-authorize-chat-user) with the [authorization scope](https://developers.google.com/workspace/chat/authenticate-authorize#chat-api-scopes): - `https://www.googleapis.com/auth/chat.users.sections`';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `name` from the official Google Chat API method.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/{+name}';
    protected const PATH_PARAMS = array (
  0 => 'name',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'name',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}
