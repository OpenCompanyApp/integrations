<?php

namespace OpenCompany\Integrations\Front\Tools;

/**
 * Execute a raw PATCH request against the Front Core API.
 */
class FrontApiPatch extends AbstractFrontTool
{
    protected const NAME = 'front_api_patch';
    protected const DESCRIPTION = 'Call any Front PATCH endpoint by path with a JSON request body.';
    protected const METHOD = 'PATCH';
    protected const PATH = '/{path}';
    protected const REQUIRED = ['path'];
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = [
        'path' => ['type' => 'string', 'required' => true, 'description' => 'API path relative to https://api2.frontapp.com.'],
        'body' => ['type' => 'object', 'required' => true, 'description' => 'JSON request body.'],
        'query' => ['type' => 'object', 'description' => 'Optional query parameters.'],
    ];
}
