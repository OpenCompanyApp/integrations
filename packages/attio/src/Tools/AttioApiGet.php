<?php

namespace OpenCompany\Integrations\Attio\Tools;

/**
 * Execute a raw GET request against the Attio REST API.
 */
class AttioApiGet extends AbstractAttioTool
{
    protected const NAME = 'attio_api_get';
    protected const DESCRIPTION = 'Call any Attio GET endpoint by path. Use this for newer or less common REST API resources.';
    protected const METHOD = 'GET';
    protected const PATH = '/{path}';
    protected const REQUIRED = ['path'];
    protected const PARAMETERS = [
        'path' => ['type' => 'string', 'required' => true, 'description' => 'API path relative to https://api.attio.com, such as /v2/lists.'],
        'query' => ['type' => 'object', 'description' => 'Optional query parameters.'],
    ];
}
