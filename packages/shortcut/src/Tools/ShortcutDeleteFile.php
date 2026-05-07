<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * Delete File.
 *
 * Maps to the official Shortcut endpoint DELETE /api/v3/files/{file-public-id}.
 */
class ShortcutDeleteFile extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_delete_file';
    protected const DESCRIPTION = 'Delete File

Official Shortcut endpoint: DELETE /api/v3/files/{file-public-id}.';
    protected const PARAMETERS = [
        'file_public_id' => [
            'type' => 'integer',
            'required' => true,
            'description' => 'The File’s unique ID.',
        ],
    ];
    protected const METHOD = 'DELETE';
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
