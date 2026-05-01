<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Get DM events for a DM conversation
 */
class XGetDirectMessagesEventsByParticipantId extends XGeneratedTool
{
    protected const SLUG = 'x_get_direct_messages_events_by_participant_id';

    protected const DESCRIPTION = 'Get DM events for a DM conversation';

    protected const PARAMETERS = [
        'participant_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The ID of the participant user for the One to One DM conversation.',
        ],
        'max_results' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'The maximum number of results.',
        ],
        'pagination_token' => [
            'type' => 'string',
            'required' => false,
            'description' => 'This parameter is used to get a specified \'page\' of results.',
        ],
        'event_types' => [
            'type' => 'array',
            'required' => false,
            'description' => 'The set of event_types to include in the results.',
            'items' => [
                'type' => 'string',
            ],
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
        'id' => 'getDirectMessagesEventsByParticipantId',
        'method' => 'GET',
        'path' => '/2/dm_conversations/with/{participant_id}/dm_events',
        'parameters' => [
            [
                'name' => 'participant_id',
                'in' => 'path',
                'required' => true,
                'style' => 'simple',
                'explode' => null,
            ],
            [
                'name' => 'max_results',
                'in' => 'query',
                'required' => false,
                'style' => 'form',
                'explode' => null,
            ],
            [
                'name' => 'pagination_token',
                'in' => 'query',
                'required' => false,
                'style' => 'form',
                'explode' => null,
            ],
            [
                'name' => 'event_types',
                'in' => 'query',
                'required' => false,
                'style' => 'form',
                'explode' => false,
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
