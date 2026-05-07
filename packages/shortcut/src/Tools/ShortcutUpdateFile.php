<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * Update File.
 *
 * Maps to the official Shortcut endpoint PUT /api/v3/files/{file-public-id}.
 */
class ShortcutUpdateFile extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_update_file';
    protected const DESCRIPTION = 'Update File

Official Shortcut endpoint: PUT /api/v3/files/{file-public-id}.';
    protected const PARAMETERS = [
        'file_public_id' => [
            'type' => 'integer',
            'required' => true,
            'description' => 'The unique ID assigned to the file in Shortcut.',
        ],
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official Shortcut API schema.',
        ],
    ];
    protected const METHOD = 'PUT';
    protected const PATH = '/api/v3/files/{file-public-id}';
    protected const PATH_PARAMS = [
        'file-public-id' => 'file_public_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'json';
}
