<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Delete DM event
 */
class XDeleteDirectMessagesEvents extends XGeneratedTool
{
    protected const SLUG = 'x_delete_direct_messages_events';

    protected const DESCRIPTION = 'Delete DM event';

    protected const PARAMETERS = [
        'event_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The ID of the direct-message event to delete.',
        ],
    ];

    protected const OPERATION = [
        'id' => 'deleteDirectMessagesEvents',
        'method' => 'DELETE',
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
            'dm.write',
        ],
        'runtime_mode' => 'request_response',
        'tags' => [
            'Direct Messages',
        ],
    ];
}
