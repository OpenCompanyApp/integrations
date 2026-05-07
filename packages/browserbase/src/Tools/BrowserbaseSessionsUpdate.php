<?php

namespace OpenCompany\Integrations\Browserbase\Tools;

/**
 * Update a Session.
 *
 * Maps to the official Browserbase endpoint POST /v1/sessions/{id}.
 */
class BrowserbaseSessionsUpdate extends AbstractBrowserbaseTool
{
    protected const NAME = 'browserbase_sessions_update';
    protected const DESCRIPTION = 'Update a Session

Official Browserbase endpoint: POST /v1/sessions/{id}.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'id',
        ],
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'JSON request body matching the official Browserbase OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/v1/sessions/{id}';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'json';
}
