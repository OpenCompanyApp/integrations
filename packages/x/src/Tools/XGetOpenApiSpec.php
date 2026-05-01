<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Get OpenAPI Spec.
 */
class XGetOpenApiSpec extends XGeneratedTool
{
    protected const SLUG = 'x_get_open_api_spec';

    protected const DESCRIPTION = 'Get OpenAPI Spec.';

    protected const PARAMETERS = [
    ];

    protected const OPERATION = [
        'id' => 'getOpenApiSpec',
        'method' => 'GET',
        'path' => '/2/openapi.json',
        'parameters' => [
        ],
        'has_body' => false,
        'body_mode' => 'json',
        'auth_modes' => [
        ],
        'required_scopes' => [
        ],
        'runtime_mode' => 'request_response',
        'tags' => [
            'General',
        ],
    ];
}
