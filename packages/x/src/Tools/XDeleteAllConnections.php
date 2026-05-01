<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Terminate all connections
 */
class XDeleteAllConnections extends XGeneratedTool
{
    protected const SLUG = 'x_delete_all_connections';

    protected const DESCRIPTION = 'Terminate all connections';

    protected const PARAMETERS = [
    ];

    protected const OPERATION = [
        'id' => 'deleteAllConnections',
        'method' => 'DELETE',
        'path' => '/2/connections/all',
        'parameters' => [
        ],
        'has_body' => false,
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
