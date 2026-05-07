<?php

namespace OpenCompany\Integrations\Front\Tools;

/**
 * Execute a raw DELETE request against the Front Core API.
 */
class FrontApiDelete extends AbstractFrontTool
{
    protected const NAME = 'front_api_delete';
    protected const DESCRIPTION = 'Call any Front DELETE endpoint by path with an optional JSON request body.';
    protected const METHOD = 'DELETE';
    protected const PATH = '/{path}';
    protected const REQUIRED = ['path'];
    protected const PARAMETERS = [
        'path' => ['type' => 'string', 'required' => true, 'description' => 'API path relative to https://api2.frontapp.com.'],
        'body' => ['type' => 'object', 'description' => 'Optional JSON request body.'],
        'query' => ['type' => 'object', 'description' => 'Optional query parameters.'],
    ];
}
