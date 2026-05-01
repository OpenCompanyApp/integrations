<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Create DM message by participant ID
 */
class XCreateDirectMessagesByParticipantId extends XGeneratedTool
{
    protected const SLUG = 'x_create_direct_messages_by_participant_id';

    protected const DESCRIPTION = 'Create DM message by participant ID';

    protected const PARAMETERS = [
        'participant_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The ID of the recipient user that will receive the DM.',
        ],
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'Request body for this X API operation. Use the shape documented by the official operation schema.',
        ],
    ];

    protected const OPERATION = [
        'id' => 'createDirectMessagesByParticipantId',
        'method' => 'POST',
        'path' => '/2/dm_conversations/with/{participant_id}/messages',
        'parameters' => [
            [
                'name' => 'participant_id',
                'in' => 'path',
                'required' => true,
                'style' => 'simple',
                'explode' => null,
            ],
        ],
        'has_body' => true,
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
            'Direct Messages',
        ],
    ];
}
