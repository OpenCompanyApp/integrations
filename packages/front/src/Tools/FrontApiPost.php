<?php

namespace OpenCompany\Integrations\Front\Tools;

/**
 * Execute a raw POST request against the Front Core API.
 */
class FrontApiPost extends AbstractFrontTool
{
    protected const NAME = 'front_api_post';
    protected const DESCRIPTION = 'Call any Front POST endpoint by path with a JSON request body.';
    protected const METHOD = 'POST';
    protected const PATH = '/{path}';
    protected const REQUIRED = ['path'];
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = [
        'path' => ['type' => 'string', 'required' => true, 'description' => 'API path relative to https://api2.frontapp.com.'],
        'body' => ['type' => 'object', 'required' => true, 'description' => 'JSON request body. Multipart file uploads are not supported by this JSON helper.'],
        'query' => ['type' => 'object', 'description' => 'Optional query parameters.'],
    ];
}
