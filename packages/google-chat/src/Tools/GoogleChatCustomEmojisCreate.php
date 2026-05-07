<?php

namespace OpenCompany\Integrations\GoogleChat\Tools;

/**
 * Custom Emojis Create.
 *
 * Maps to the official Google Chat endpoint POST /v1/customEmojis.
 */
class GoogleChatCustomEmojisCreate extends AbstractGoogleChatTool
{
    protected const NAME = 'google_chat_custom_emojis_create';
    protected const DESCRIPTION = 'Custom Emojis Create

Official Google Chat endpoint: POST /v1/customEmojis
Creates a custom emoji. Custom emojis are only available for Google Workspace accounts, and the administrator must turn custom emojis on for the organization. For more information, see [Learn about custom emojis in Google Chat](https://support.google.com/chat/answer/12800149) and [Manage custom emoji permissions](https://support.google.com/a/answer/12850085). Requires [user authentication](https://developers.google.com/workspace/chat/authenticate-authorize-chat-user) with the [authorization scope](https://developers.google.com/workspace/chat/authenticate-authorize#chat-api-scopes): - `https://www.googleapis.com/auth/chat.customemojis`';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Google Chat API `CustomEmoji` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/customEmojis';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}
