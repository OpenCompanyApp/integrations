<?php

namespace OpenCompany\Integrations\GoogleChat\Tools;

/**
 * Users Sections List.
 *
 * Maps to the official Google Chat endpoint GET /v1/{+parent}/sections.
 */
class GoogleChatUsersSectionsList extends AbstractGoogleChatTool
{
    protected const NAME = 'google_chat_users_sections_list';
    protected const DESCRIPTION = 'Users Sections List

Official Google Chat endpoint: GET /v1/{+parent}/sections
Lists sections available to the Chat user. Sections help users group their conversations and customize the list of spaces displayed in Chat navigation panel. For details, see [Create and organize sections in Google Chat](https://support.google.com/chat/answer/16059854). Requires [user authentication](https://developers.google.com/workspace/chat/authenticate-authorize-chat-user) with the [authorization scope](https://developers.google.com/workspace/chat/authenticate-authorize#chat-api-scopes): - `https://www.googleapis.com/auth/chat.users.sections` - `https://www.googleapis.com/auth/chat.users.sections.readonly`';
    protected const PARAMETERS = array (
  'parent' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `parent` from the official Google Chat API method.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters accepted by the official Chat method. Known keys: pageToken, pageSize.',
  ),
  'pageToken' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Optional. A page token, received from a previous list sections call. Provide this to retrieve the subsequent page. When paginating, all other parameters provided should match the call that provided the page token. Passing different values to the other parameters might lead to unexpected results.',
  ),
  'pageSize' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Optional. The maximum number of sections to return. The service may return fewer than this value. If unspecified, at most 10 sections will be returned. The maximum value is 100. If you use a value more than 100, it\'s automatically changed to 100. Negative values return an `INVALID_ARGUMENT` error.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/{+parent}/sections';
    protected const PATH_PARAMS = array (
  0 => 'parent',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'parent',
);
    protected const QUERY_KEYS = array (
  0 => 'pageToken',
  1 => 'pageSize',
);
    protected const BODY_REQUIRED = false;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}
