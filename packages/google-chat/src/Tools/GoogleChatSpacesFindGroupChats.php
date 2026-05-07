<?php

namespace OpenCompany\Integrations\GoogleChat\Tools;

/**
 * Spaces Find Group Chats.
 *
 * Maps to the official Google Chat endpoint GET /v1/spaces:findGroupChats.
 */
class GoogleChatSpacesFindGroupChats extends AbstractGoogleChatTool
{
    protected const NAME = 'google_chat_spaces_find_group_chats';
    protected const DESCRIPTION = 'Spaces Find Group Chats

Official Google Chat endpoint: GET /v1/spaces:findGroupChats
Returns all spaces with `spaceType == GROUP_CHAT`, whose human memberships contain exactly the calling user, and the users specified in `FindGroupChatsRequest.users`. Only members that have joined the conversation are supported. For an example, see [Find group chats](https://developers.google.com/workspace/chat/find-group-chats). If the calling user blocks, or is blocked by, some users, and no spaces with the entire specified set of users are found, this method returns spaces that don\'t include the blocked or blocking users. The specified set of users must contain only human (non-app) memberships. A request that contains non-human users doesn\'t return any spaces. Requires [user authentication](https://developers.google.com/workspace/chat/authenticate-authorize-chat-user) with one of the following [authorization scopes](https://developers.google.com/workspace/chat/authenticate-authorize#chat-api-scopes): - `https://www.googleapis.com/auth/chat.memberships.readonly` - `https://www.googleapis.com/auth/chat.memberships`';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Chat method. Known keys: pageToken, users, pageSize, spaceView.',
  ),
  'pageToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Optional. A page token, received from a previous call to find group chats. Provide this parameter to retrieve the subsequent page. When paginating, all other parameters provided should match the call that provided the token. Passing different values may lead to unexpected results.',
  ),
  'users' =>
  array (
    'type' => 'array',
    'required' => false,
    'description' => 'Optional. Resource names of all human users in group chat with the calling user. Chat apps can\'t be included in the request. The maximum number of users that can be specified in a single request is `49`. Format: `users/{user}`, where `{user}` is either the `id` for the [person](https://developers.google.com/people/api/rest/v1/people) from the People API, or the `id` for the [user](https://developers.google.com/admin-sdk/directory/reference/rest/v1/users) in the Directory API. For example, to find all group chats with the calling user and two other users, with People API profile IDs `123456789` and `987654321`, you can use `users/123456789` and `users/987654321`. You can also use the email as an alias for `{user}`. For example, `users/example@gmail.com` where `example@gmail.com` is the email of the Google Chat user.',
    'items' =>
    array (
      'type' => 'string',
    ),
  ),
  'pageSize' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Optional. The maximum number of spaces to return. The service might return fewer than this value. If unspecified, at most 10 spaces are returned. The maximum value is 30. If you use a value more than 30, it\'s automatically changed to 30. Negative values return an `INVALID_ARGUMENT` error.',
  ),
  'spaceView' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Requested space view type. If unset, defaults to `SPACE_VIEW_RESOURCE_NAME_ONLY`. Requests that specify `SPACE_VIEW_EXPANDED` must include scopes that allow reading space data, for example, https://www.googleapis.com/auth/chat.spaces or https://www.googleapis.com/auth/chat.spaces.readonly.',
    'enum' =>
    array (
      0 => 'SPACE_VIEW_UNSPECIFIED',
      1 => 'SPACE_VIEW_RESOURCE_NAME_ONLY',
      2 => 'SPACE_VIEW_EXPANDED',
    ),
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/spaces:findGroupChats';
    protected const PATH_PARAMS = array (
);
    protected const RESERVED_PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'pageToken',
  1 => 'users',
  2 => 'pageSize',
  3 => 'spaceView',
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}
