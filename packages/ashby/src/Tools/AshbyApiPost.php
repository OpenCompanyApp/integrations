<?php

namespace OpenCompany\Integrations\Ashby\Tools;

/**
 * Execute a raw POST request against any Ashby RPC endpoint.
 */
class AshbyApiPost extends AbstractAshbyTool
{
    protected const NAME = 'ashby_api_post';
    protected const DESCRIPTION = 'Call any Ashby API endpoint by RPC path, such as /candidate.list or /application.info.';
    protected const ENDPOINT = '{endpoint}';
    protected const REQUIRED = ['endpoint'];
    protected const PARAMETERS = [
        'endpoint' => ['type' => 'string', 'required' => true, 'description' => 'Ashby endpoint path, such as /candidate.list.'],
        'body' => ['type' => 'object', 'description' => 'JSON request body.'],
    ];
}
