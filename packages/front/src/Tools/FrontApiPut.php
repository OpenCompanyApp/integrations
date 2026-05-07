<?php

namespace OpenCompany\Integrations\Front\Tools;

/**
 * Execute a raw PUT request against the Front Core API.
 */
class FrontApiPut extends AbstractFrontTool
{
    protected const NAME = 'front_api_put';
    protected const DESCRIPTION = 'Call any Front PUT endpoint by path with a JSON request body.';
    protected const METHOD = 'PUT';
    protected const PATH = '/{path}';
    protected const REQUIRED = ['path'];
    protected const PARAMETERS = [
        'path' => ['type' => 'string', 'required' => true, 'description' => 'API path relative to https://api2.frontapp.com.'],
        'body' => ['type' => 'object', 'description' => 'JSON request body.'],
        'query' => ['type' => 'object', 'description' => 'Optional query parameters.'],
    ];
}
