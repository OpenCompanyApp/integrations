<?php

namespace OpenCompany\Integrations\GoogleChat\Tools;

/**
 * Users Spaces Threads Get Thread Read State.
 *
 * Maps to the official Google Chat endpoint GET /v1/{+name}.
 */
class GoogleChatUsersSpacesThreadsGetThreadReadState extends AbstractGoogleChatTool
{
    protected const NAME = 'google_chat_users_spaces_threads_get_thread_read_state';
    protected const DESCRIPTION = 'Users Spaces Threads Get Thread Read State

Official Google Chat endpoint: GET /v1/{+name}
Returns details about a user\'s read state within a thread, used to identify read and unread messages. For an example, see [Get details about a user\'s thread read state](https://developers.google.com/workspace/chat/get-thread-read-state). Requires [user authentication](https://developers.google.com/workspace/chat/authenticate-authorize-chat-user) with one of the following [authorization scopes](https://developers.google.com/workspace/chat/authenticate-authorize#chat-api-scopes): - `https://www.googleapis.com/auth/chat.users.readstate.readonly` - `https://www.googleapis.com/auth/chat.users.readstate`';
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
