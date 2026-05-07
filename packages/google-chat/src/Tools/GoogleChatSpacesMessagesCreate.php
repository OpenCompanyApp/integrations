<?php

namespace OpenCompany\Integrations\GoogleChat\Tools;

/**
 * Spaces Messages Create.
 *
 * Maps to the official Google Chat endpoint POST /v1/{+parent}/messages.
 */
class GoogleChatSpacesMessagesCreate extends AbstractGoogleChatTool
{
    protected const NAME = 'google_chat_spaces_messages_create';
    protected const DESCRIPTION = 'Spaces Messages Create

Official Google Chat endpoint: POST /v1/{+parent}/messages
Creates a message in a Google Chat space. For an example, see [Send a message](https://developers.google.com/workspace/chat/create-messages). Supports the following types of [authentication](https://developers.google.com/workspace/chat/authenticate-authorize): - [App authentication](https://developers.google.com/workspace/chat/authenticate-authorize-chat-app) with the authorization scope: - `https://www.googleapis.com/auth/chat.bot` - [User authentication](https://developers.google.com/workspace/chat/authenticate-authorize-chat-user) with one of the following authorization scopes: - `https://www.googleapis.com/auth/chat.messages.create` - `https://www.googleapis.com/auth/chat.messages` - `https://www.googleapis.com/auth/chat.import` (import mode spaces only) Chat attributes the message sender differently depending on the type of authentication that you use in your request. The following image shows how Chat attributes a message when you use app authentication. Chat displays the Chat app as the message sender. The content of the message can contain text (`text`), cards (`cardsV2`), and accessory widgets (`accessoryWidgets`). ![Message sent with app authentication](https://developers.google.com/workspace/chat/images/message-app-auth.svg) The following image shows how Chat attributes a message when you use user authentication. Chat displays the user as the message sender and attributes the Chat app to the message by displaying its name. The content of message can only contain text (`text`). ![Message sent with user authentication](https://developers.google.com/workspace/chat/images/message-user-auth.svg) The maximum message size, including the message contents, is 32,000 bytes. For [webhook](https://developers.google.com/workspace/chat/quickstart/webhooks) requests, the response doesn\'t contain the full message. The response only populates the `name` and `thread.name` fields in addition to the information that was in the request.';
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
    'description' => 'Query string parameters accepted by the official Chat method. Known keys: messageReplyOption, requestId, threadKey, messageId.',
  ),
  'messageReplyOption' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Optional. Specifies whether a message starts a thread or replies to one. Only supported in named spaces. When [responding to user interactions](https://developers.google.com/workspace/chat/receive-respond-interactions), this field is ignored. For interactions within a thread, the reply is created in the same thread. Otherwise, the reply is created as a new thread.',
    'enum' =>
    array (
      0 => 'MESSAGE_REPLY_OPTION_UNSPECIFIED',
      1 => 'REPLY_MESSAGE_FALLBACK_TO_NEW_THREAD',
      2 => 'REPLY_MESSAGE_OR_FAIL',
    ),
  ),
  'requestId' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Optional. A unique request ID for this message. Specifying an existing request ID returns the message created with that ID instead of creating a new message.',
  ),
  'threadKey' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Optional. Deprecated: Use thread.thread_key instead. ID for the thread. Supports up to 4000 characters. To start or add to a thread, create a message and specify a `threadKey` or the thread.name. For example usage, see [Start or reply to a message thread](https://developers.google.com/workspace/chat/create-messages#create-message-thread).',
  ),
  'messageId' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Optional. A custom ID for a message. Lets Chat apps get, update, or delete a message without needing to store the system-assigned ID in the message\'s resource name (represented in the message `name` field). The value for this field must meet the following requirements: * Begins with `client-`. For example, `client-custom-name` is a valid custom ID, but `custom-name` is not. * Contains up to 63 characters and only lowercase letters, numbers, and hyphens. * Is unique within a space. A Chat app can\'t use the same custom ID for different messages. For details, see [Name a message](https://developers.google.com/workspace/chat/create-messages#name_a_created_message).',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Google Chat API `Message` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/{+parent}/messages';
    protected const PATH_PARAMS = array (
  0 => 'parent',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'parent',
);
    protected const QUERY_KEYS = array (
  0 => 'messageReplyOption',
  1 => 'requestId',
  2 => 'threadKey',
  3 => 'messageId',
);
    protected const BODY_REQUIRED = true;
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';
}
