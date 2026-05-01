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
        'dm_event.fields' => [
            'type' => 'array',
            'required' => false,
            'description' => 'A comma separated list of DmEvent fields to display.',
            'items' => [
                'type' => 'string',
            ],
        ],
        'expansions' => [
            'type' => 'array',
            'required' => false,
            'description' => 'A comma separated list of fields to expand.',
            'items' => [
                'type' => 'string',
            ],
        ],
        'media.fields' => [
            'type' => 'array',
            'required' => false,
            'description' => 'A comma separated list of Media fields to display.',
            'items' => [
                'type' => 'string',
            ],
        ],
        'user.fields' => [
            'type' => 'array',
            'required' => false,
            'description' => 'A comma separated list of User fields to display.',
            'items' => [
                'type' => 'string',
            ],
        ],
        'tweet.fields' => [
            'type' => 'array',
            'required' => false,
            'description' => 'A comma separated list of Tweet fields to display.',
            'items' => [
                'type' => 'string',
            ],
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
            [
                'name' => 'dm_event.fields',
                'in' => 'query',
                'required' => false,
                'style' => 'form',
                'explode' => false,
            ],
            [
                'name' => 'expansions',
                'in' => 'query',
                'required' => false,
                'style' => 'form',
                'explode' => false,
            ],
            [
                'name' => 'media.fields',
                'in' => 'query',
                'required' => false,
                'style' => 'form',
                'explode' => false,
            ],
            [
                'name' => 'user.fields',
                'in' => 'query',
                'required' => false,
                'style' => 'form',
                'explode' => false,
            ],
            [
                'name' => 'tweet.fields',
                'in' => 'query',
                'required' => false,
                'style' => 'form',
                'explode' => false,
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
