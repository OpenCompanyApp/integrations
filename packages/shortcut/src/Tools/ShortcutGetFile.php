<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * Get File.
 *
 * Maps to the official Shortcut endpoint GET /api/v3/files/{file-public-id}.
 */
class ShortcutGetFile extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_get_file';
    protected const DESCRIPTION = 'Get File

Official Shortcut endpoint: GET /api/v3/files/{file-public-id}.';
    protected const PARAMETERS = [
        'file_public_id' => [
            'type' => 'integer',
            'required' => true,
            'description' => 'The File’s unique ID.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v3/files/{file-public-id}';
    protected const PATH_PARAMS = [
        'file-public-id' => 'file_public_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}
