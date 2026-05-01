<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Get DM event by ID
 */
class XGetDirectMessagesEventsById extends XGeneratedTool
{
    protected const SLUG = 'x_get_direct_messages_events_by_id';

    protected const DESCRIPTION = 'Get DM event by ID';

    protected const PARAMETERS = [
        'event_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'dm event id.',
        ],
    ];

    protected const OPERATION = [
        'id' => 'getDirectMessagesEventsById',
        'method' => 'GET',
        'path' => '/2/dm_events/{event_id}',
        'parameters' => [
            [
                'name' => 'event_id',
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
            'dm.read',
            'tweet.read',
            'users.read',
        ],
        'runtime_mode' => 'request_response',
        'tags' => [
            'Direct Messages',
        ],
    ];
}
