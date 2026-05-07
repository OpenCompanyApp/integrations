<?php

namespace OpenCompany\Integrations\Browserbase\Tools;

/**
 * Delete a Context.
 *
 * Maps to the official Browserbase endpoint DELETE /v1/contexts/{id}.
 */
class BrowserbaseContextsDelete extends AbstractBrowserbaseTool
{
    protected const NAME = 'browserbase_contexts_delete';
    protected const DESCRIPTION = 'Delete a Context

Official Browserbase endpoint: DELETE /v1/contexts/{id}.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'id',
        ],
    ];
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/contexts/{id}';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}
