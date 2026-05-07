<?php

namespace OpenCompany\Integrations\Browserbase\Tools;

/**
 * Get Project Usage.
 *
 * Maps to the official Browserbase endpoint GET /v1/projects/{id}/usage.
 */
class BrowserbaseProjectsUsage extends AbstractBrowserbaseTool
{
    protected const NAME = 'browserbase_projects_usage';
    protected const DESCRIPTION = 'Get Project Usage

Official Browserbase endpoint: GET /v1/projects/{id}/usage.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'id',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/projects/{id}/usage';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}
