<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Terminate multiple connections
 */
class XDeleteConnectionsByUuids extends XGeneratedTool
{
    protected const SLUG = 'x_delete_connections_by_uuids';

    protected const DESCRIPTION = 'Terminate multiple connections';

    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body for this X API operation. Use the shape documented by the official operation schema.',
        ],
    ];

    protected const OPERATION = [
        'id' => 'deleteConnectionsByUuids',
        'method' => 'DELETE',
        'path' => '/2/connections',
        'parameters' => [
        ],
        'has_body' => true,
        'body_mode' => 'json',
        'auth_modes' => [
            'bearer_token',
        ],
        'required_scopes' => [
        ],
        'runtime_mode' => 'request_response',
        'tags' => [
            'Connections',
        ],
    ];
}
