<?php

namespace OpenCompany\Integrations\Browserbase\Tools;

/**
 * Delete a Download.
 *
 * Maps to the official Browserbase endpoint DELETE /v1/downloads/{id}.
 */
class BrowserbaseDownloadsDelete extends AbstractBrowserbaseTool
{
    protected const NAME = 'browserbase_downloads_delete';
    protected const DESCRIPTION = 'Delete a Download

Official Browserbase endpoint: DELETE /v1/downloads/{id}.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The download ID to delete.',
        ],
    ];
    protected const METHOD = 'DELETE';
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
