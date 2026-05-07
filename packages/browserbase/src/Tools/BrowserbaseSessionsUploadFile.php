<?php

namespace OpenCompany\Integrations\Browserbase\Tools;

/**
 * Create Session Uploads.
 *
 * Maps to the official Browserbase endpoint POST /v1/sessions/{id}/uploads.
 */
class BrowserbaseSessionsUploadFile extends AbstractBrowserbaseTool
{
    protected const NAME = 'browserbase_sessions_upload_file';
    protected const DESCRIPTION = 'Create Session Uploads

Official Browserbase endpoint: POST /v1/sessions/{id}/uploads.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'id',
        ],
        'file' => [
            'type' => 'string',
            'required' => true,
            'description' => 'file Provide a local file path for upload.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/v1/sessions/{id}/uploads';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const FORM_PARAMS = [
        'file' => 'file',
    ];
    protected const FORM_REQUIRED_PARAMS = [
        'file' => 'file',
    ];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'multipart';
}
