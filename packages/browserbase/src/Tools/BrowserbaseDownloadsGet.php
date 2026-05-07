<?php

namespace OpenCompany\Integrations\Browserbase\Tools;

/**
 * Get a Download.
 *
 * Maps to the official Browserbase endpoint GET /v1/downloads/{id}.
 */
class BrowserbaseDownloadsGet extends AbstractBrowserbaseTool
{
    protected const NAME = 'browserbase_downloads_get';
    protected const DESCRIPTION = 'Get a Download

Official Browserbase endpoint: GET /v1/downloads/{id}.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The download ID.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/downloads/{id}';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}
