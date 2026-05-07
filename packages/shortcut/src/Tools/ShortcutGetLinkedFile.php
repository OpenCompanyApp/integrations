<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * Get Linked File.
 *
 * Maps to the official Shortcut endpoint GET /api/v3/linked-files/{linked-file-public-id}.
 */
class ShortcutGetLinkedFile extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_get_linked_file';
    protected const DESCRIPTION = 'Get Linked File

Official Shortcut endpoint: GET /api/v3/linked-files/{linked-file-public-id}.';
    protected const PARAMETERS = [
        'linked_file_public_id' => [
            'type' => 'integer',
            'required' => true,
            'description' => 'The unique identifier of the linked file.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v3/linked-files/{linked-file-public-id}';
    protected const PATH_PARAMS = [
        'linked-file-public-id' => 'linked_file_public_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}
