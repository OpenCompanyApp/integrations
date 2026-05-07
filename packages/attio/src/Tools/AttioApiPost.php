<?php

namespace OpenCompany\Integrations\Attio\Tools;

/**
 * Execute a raw POST request against the Attio REST API.
 */
class AttioApiPost extends AbstractAttioTool
{
    protected const NAME = 'attio_api_post';
    protected const DESCRIPTION = 'Call any Attio POST endpoint by path with a JSON request body.';
    protected const METHOD = 'POST';
    protected const PATH = '/{path}';
    protected const REQUIRED = ['path'];
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = [
        'path' => ['type' => 'string', 'required' => true, 'description' => 'API path relative to https://api.attio.com.'],
        'body' => ['type' => 'object', 'required' => true, 'description' => 'JSON request body.'],
        'query' => ['type' => 'object', 'description' => 'Optional query parameters.'],
    ];
}
