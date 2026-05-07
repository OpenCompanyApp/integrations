<?php

namespace OpenCompany\Integrations\Front\Tools;

/**
 * Execute a raw GET request against the Front Core API.
 */
class FrontApiGet extends AbstractFrontTool
{
    protected const NAME = 'front_api_get';
    protected const DESCRIPTION = 'Call any Front GET endpoint by path. Use this for newer or less common Core API resources.';
    protected const METHOD = 'GET';
    protected const PATH = '/{path}';
    protected const REQUIRED = ['path'];
    protected const PARAMETERS = [
        'path' => ['type' => 'string', 'required' => true, 'description' => 'API path relative to https://api2.frontapp.com, such as /tags or /conversations/search/billing.'],
        'query' => ['type' => 'object', 'description' => 'Optional query parameters.'],
    ];
}
