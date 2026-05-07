<?php

namespace OpenCompany\Integrations\GoogleChat\Tools;

/**
 * Users Spaces Space Notification Setting Get.
 *
 * Maps to the official Google Chat endpoint GET /v1/{+name}.
 */
class GoogleChatUsersSpacesSpaceNotificationSettingGet extends AbstractGoogleChatTool
{
    protected const NAME = 'google_chat_users_spaces_space_notification_setting_get';
    protected const DESCRIPTION = 'Users Spaces Space Notification Setting Get

Official Google Chat endpoint: GET /v1/{+name}
Gets the space notification setting. For an example, see [Get the caller\'s space notification setting](https://developers.google.com/workspace/chat/get-space-notification-setting). Requires [user authentication](https://developers.google.com/workspace/chat/authenticate-authorize-chat-user) with the [authorization scope](https://developers.google.com/workspace/chat/authenticate-authorize#chat-api-scopes): - `https://www.googleapis.com/auth/chat.users.spacesettings`';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `name` from the official Google Chat API method.',
  ),
);
    protected const METHOD = 'GET';
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
