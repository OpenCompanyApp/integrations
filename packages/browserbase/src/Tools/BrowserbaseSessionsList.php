<?php

namespace OpenCompany\Integrations\Browserbase\Tools;

/**
 * List Sessions.
 *
 * Maps to the official Browserbase endpoint GET /v1/sessions.
 */
class BrowserbaseSessionsList extends AbstractBrowserbaseTool
{
    protected const NAME = 'browserbase_sessions_list';
    protected const DESCRIPTION = 'List Sessions

Official Browserbase endpoint: GET /v1/sessions.';
    protected const PARAMETERS = [
        'status' => [
            'type' => 'string',
            'required' => false,
            'description' => 'status',
            'enum' => [
                'PENDING',
                'RUNNING',
                'ERROR',
                'TIMED_OUT',
                'COMPLETED',
            ],
        ],
        'q' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Query sessions by user metadata. See [Querying Sessions by User Metadata](/features/sessions#querying-sessions-by-user-metadata) for the schema of this query.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/sessions';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'status' => 'status',
        'q' => 'q',
    ];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}
