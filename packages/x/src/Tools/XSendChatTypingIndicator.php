<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Send Typing Indicator
 */
class XSendChatTypingIndicator extends XGeneratedTool
{
    protected const SLUG = 'x_send_chat_typing_indicator';

    protected const DESCRIPTION = 'Send Typing Indicator';

    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The recipient\'s user ID for a 1:1 conversation, or a group conversation ID (prefixed with \'g\').',
        ],
    ];

    protected const OPERATION = [
        'id' => 'sendChatTypingIndicator',
        'method' => 'POST',
        'path' => '/2/chat/conversations/{id}/typing',
        'parameters' => [
            [
                'name' => 'id',
                'in' => 'path',
                'required' => true,
                'style' => 'simple',
                'explode' => null,
            ],
        ],
        'has_body' => false,
        'body_mode' => 'json',
        'auth_modes' => [
            'oauth2_pkce',
            'oauth1a_user_context',
        ],
        'required_scopes' => [
            'dm.write',
            'tweet.read',
            'users.read',
        ],
        'runtime_mode' => 'request_response',
        'tags' => [
            'Chat',
        ],
    ];
}
