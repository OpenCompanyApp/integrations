<?php

namespace OpenCompany\Integrations\Attio\Tools;

/**
 * Execute a raw DELETE request against the Attio REST API.
 */
class AttioApiDelete extends AbstractAttioTool
{
    protected const NAME = 'attio_api_delete';
    protected const DESCRIPTION = 'Call any Attio DELETE endpoint by path.';
    protected const METHOD = 'DELETE';
    protected const PATH = '/{path}';
    protected const REQUIRED = ['path'];
    protected const PARAMETERS = [
        'path' => ['type' => 'string', 'required' => true, 'description' => 'API path relative to https://api.attio.com.'],
        'body' => ['type' => 'object', 'description' => 'Optional JSON request body for endpoints that accept one.'],
        'query' => ['type' => 'object', 'description' => 'Optional query parameters.'],
    ];
}
