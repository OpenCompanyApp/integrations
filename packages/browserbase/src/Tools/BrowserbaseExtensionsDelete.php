<?php

namespace OpenCompany\Integrations\Browserbase\Tools;

/**
 * Delete an Extension.
 *
 * Maps to the official Browserbase endpoint DELETE /v1/extensions/{id}.
 */
class BrowserbaseExtensionsDelete extends AbstractBrowserbaseTool
{
    protected const NAME = 'browserbase_extensions_delete';
    protected const DESCRIPTION = 'Delete an Extension

Official Browserbase endpoint: DELETE /v1/extensions/{id}.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'id',
        ],
    ];
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/extensions/{id}';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}
