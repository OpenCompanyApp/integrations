<?php

namespace OpenCompany\Integrations\GoogleChat\Tools;

/**
 * Spaces Messages Reactions Delete.
 *
 * Maps to the official Google Chat endpoint DELETE /v1/{+name}.
 */
class GoogleChatSpacesMessagesReactionsDelete extends AbstractGoogleChatTool
{
    protected const NAME = 'google_chat_spaces_messages_reactions_delete';
    protected const DESCRIPTION = 'Spaces Messages Reactions Delete

Official Google Chat endpoint: DELETE /v1/{+name}
Deletes a reaction to a message. For an example, see [Delete a reaction](https://developers.google.com/workspace/chat/delete-reactions). Requires [user authentication](https://developers.google.com/workspace/chat/authenticate-authorize-chat-user) with one of the following [authorization scopes](https://developers.google.com/workspace/chat/authenticate-authorize#chat-api-scopes): - `https://www.googleapis.com/auth/chat.messages.reactions` - `https://www.googleapis.com/auth/chat.messages` - `https://www.googleapis.com/auth/chat.import` (import mode spaces only)';
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
