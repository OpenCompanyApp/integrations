<?php

namespace OpenCompany\Integrations\Browserbase\Tools;

/**
 * Upload an Extension.
 *
 * Maps to the official Browserbase endpoint POST /v1/extensions.
 */
class BrowserbaseExtensionsUpload extends AbstractBrowserbaseTool
{
    protected const NAME = 'browserbase_extensions_upload';
    protected const DESCRIPTION = 'Upload an Extension

Official Browserbase endpoint: POST /v1/extensions.';
    protected const PARAMETERS = [
        'file' => [
            'type' => 'string',
            'required' => true,
            'description' => 'file Provide a local file path for upload.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/v1/extensions';
    protected const PATH_PARAMS = [];
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
