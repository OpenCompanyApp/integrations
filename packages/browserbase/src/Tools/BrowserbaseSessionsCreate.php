<?php

namespace OpenCompany\Integrations\Browserbase\Tools;

/**
 * Create a Session.
 *
 * Maps to the official Browserbase endpoint POST /v1/sessions.
 */
class BrowserbaseSessionsCreate extends AbstractBrowserbaseTool
{
    protected const NAME = 'browserbase_sessions_create';
    protected const DESCRIPTION = 'Create a Session

Official Browserbase endpoint: POST /v1/sessions.';
    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'JSON request body matching the official Browserbase OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/v1/sessions';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}
