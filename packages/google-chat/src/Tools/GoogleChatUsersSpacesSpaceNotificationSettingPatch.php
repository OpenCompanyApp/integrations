<?php

namespace OpenCompany\Integrations\GoogleChat\Tools;

/**
 * Users Spaces Space Notification Setting Patch.
 *
 * Maps to the official Google Chat endpoint PATCH /v1/{+name}.
 */
class GoogleChatUsersSpacesSpaceNotificationSettingPatch extends AbstractGoogleChatTool
{
    protected const NAME = 'google_chat_users_spaces_space_notification_setting_patch';
    protected const DESCRIPTION = 'Users Spaces Space Notification Setting Patch

Official Google Chat endpoint: PATCH /v1/{+name}
Updates the space notification setting. For an example, see [Update the caller\'s space notification setting](https://developers.google.com/workspace/chat/update-space-notification-setting). Requires [user authentication](https://developers.google.com/workspace/chat/authenticate-authorize-chat-user) with the [authorization scope](https://developers.google.com/workspace/chat/authenticate-authorize#chat-api-scopes): - `https://www.googleapis.com/auth/chat.users.spacesettings`';
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
    'description' => 'Required. Supported field paths: - `notification_setting` - `mute_setting`',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Google Chat API `SpaceNotificationSetting` schema.',
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
