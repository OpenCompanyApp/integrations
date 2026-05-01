<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Initialize Chat Group
 */
class XInitializeChatGroup extends XGeneratedTool
{
    protected const SLUG = 'x_initialize_chat_group';

    protected const DESCRIPTION = 'Initialize Chat Group';

    protected const PARAMETERS = [
    ];

    protected const OPERATION = [
        'id' => 'initializeChatGroup',
        'method' => 'POST',
        'path' => '/2/chat/conversations/group/initialize',
        'parameters' => [
        ],
        'has_body' => false,
        'body_mode' => 'json',
        'auth_modes' => [
            'oauth2_pkce',
            'oauth1a_user_context',
        ],
        'required_scopes' => [
            'dm.write',
        ],
        'runtime_mode' => 'request_response',
        'tags' => [
            'Chat',
        ],
    ];
}
