<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * Upload Files.
 *
 * Maps to the official Shortcut endpoint POST /api/v3/files.
 */
class ShortcutUploadFiles extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_upload_files';
    protected const DESCRIPTION = 'Upload Files

Official Shortcut endpoint: POST /api/v3/files.';
    protected const PARAMETERS = [
        'story_id' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'The story ID that these files will be associated with.',
        ],
        'file0' => [
            'type' => 'string',
            'required' => true,
            'description' => 'A file upload. At least one is required. Provide a local file path for upload.',
        ],
        'file1' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Optional additional files. Provide a local file path for upload.',
        ],
        'file2' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Optional additional files. Provide a local file path for upload.',
        ],
        'file3' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Optional additional files. Provide a local file path for upload.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/api/v3/files';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const FORM_PARAMS = [
        'story_id' => 'story_id',
        'file0' => 'file0',
        'file1' => 'file1',
        'file2' => 'file2',
        'file3' => 'file3',
    ];
    protected const FORM_REQUIRED_PARAMS = [
        'file0' => 'file0',
    ];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'multipart';
}
