<?php

namespace OpenCompany\Integrations\Browserbase\Tools;

/**
 * Get an Invocation.
 *
 * Maps to the official Browserbase endpoint GET /v1/functions/invocations/{id}.
 */
class BrowserbaseInvocationsGet extends AbstractBrowserbaseTool
{
    protected const NAME = 'browserbase_invocations_get';
    protected const DESCRIPTION = 'Get an Invocation

Official Browserbase endpoint: GET /v1/functions/invocations/{id}.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'id',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/functions/invocations/{id}';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}
