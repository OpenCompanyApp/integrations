<?php

namespace OpenCompany\Integrations\Browserless\Tools;

/**
 * /session.
 *
 * Maps to the official Browserless endpoint POST /session.
 */
class BrowserlessPostSession extends AbstractBrowserlessTool
{
    protected const NAME = 'browserless_post_session';
    protected const DESCRIPTION = '/session

Official Browserless endpoint: POST /session.';
    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'JSON request body matching the Browserless OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/session';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const OPTIONAL_PATH_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}
