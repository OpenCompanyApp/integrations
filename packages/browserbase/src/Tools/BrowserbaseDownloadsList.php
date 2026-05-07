<?php

namespace OpenCompany\Integrations\Browserbase\Tools;

/**
 * List Downloads.
 *
 * Maps to the official Browserbase endpoint GET /v1/downloads.
 */
class BrowserbaseDownloadsList extends AbstractBrowserbaseTool
{
    protected const NAME = 'browserbase_downloads_list';
    protected const DESCRIPTION = 'List Downloads

Official Browserbase endpoint: GET /v1/downloads.';
    protected const PARAMETERS = [
        'session_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Filter downloads by session ID (required).',
        ],
        'filename' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Filter by exact filename match.',
        ],
        'mime_type' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Filter by MIME type.',
        ],
        'min_size' => [
            'type' => 'number',
            'required' => false,
            'description' => 'Minimum file size in bytes.',
        ],
        'max_size' => [
            'type' => 'number',
            'required' => false,
            'description' => 'Maximum file size in bytes.',
        ],
        'created_after' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Filter downloads created on or after this timestamp.',
        ],
        'created_before' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Filter downloads created on or before this timestamp.',
        ],
        'limit' => [
            'type' => 'number',
            'required' => false,
            'description' => 'Maximum number of results to return.',
        ],
        'offset' => [
            'type' => 'number',
            'required' => false,
            'description' => 'Number of results to skip for pagination.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/downloads';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'sessionId' => 'session_id',
        'filename' => 'filename',
        'mimeType' => 'mime_type',
        'minSize' => 'min_size',
        'maxSize' => 'max_size',
        'createdAfter' => 'created_after',
        'createdBefore' => 'created_before',
        'limit' => 'limit',
        'offset' => 'offset',
    ];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}
