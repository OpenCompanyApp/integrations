<?php

namespace OpenCompany\Integrations\GoogleChat\Tools;

/**
 * Spaces Messages Attachments Get.
 *
 * Maps to the official Google Chat endpoint GET /v1/{+name}.
 */
class GoogleChatSpacesMessagesAttachmentsGet extends AbstractGoogleChatTool
{
    protected const NAME = 'google_chat_spaces_messages_attachments_get';
    protected const DESCRIPTION = 'Spaces Messages Attachments Get

Official Google Chat endpoint: GET /v1/{+name}
Gets the metadata of a message attachment. The attachment data is fetched using the [media API](https://developers.google.com/workspace/chat/api/reference/rest/v1/media/download). For an example, see [Get metadata about a message attachment](https://developers.google.com/workspace/chat/get-media-attachments). Requires [app authentication](https://developers.google.com/workspace/chat/authenticate-authorize-chat-app) with the [authorization scope](https://developers.google.com/workspace/chat/authenticate-authorize#chat-api-scopes): - `https://www.googleapis.com/auth/chat.bot`';
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
