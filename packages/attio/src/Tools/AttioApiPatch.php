<?php

namespace OpenCompany\Integrations\Attio\Tools;

/**
 * Execute a raw PATCH request against the Attio REST API.
 */
class AttioApiPatch extends AbstractAttioTool
{
    protected const NAME = 'attio_api_patch';
    protected const DESCRIPTION = 'Call any Attio PATCH endpoint by path with a JSON request body.';
    protected const METHOD = 'PATCH';
    protected const PATH = '/{path}';
    protected const REQUIRED = ['path'];
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = [
        'path' => ['type' => 'string', 'required' => true, 'description' => 'API path relative to https://api.attio.com.'],
        'body' => ['type' => 'object', 'required' => true, 'description' => 'JSON request body.'],
        'query' => ['type' => 'object', 'description' => 'Optional query parameters.'],
    ];
}
