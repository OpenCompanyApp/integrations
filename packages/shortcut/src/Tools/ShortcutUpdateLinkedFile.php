<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * Update Linked File.
 *
 * Maps to the official Shortcut endpoint PUT /api/v3/linked-files/{linked-file-public-id}.
 */
class ShortcutUpdateLinkedFile extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_update_linked_file';
    protected const DESCRIPTION = 'Update Linked File

Official Shortcut endpoint: PUT /api/v3/linked-files/{linked-file-public-id}.';
    protected const PARAMETERS = [
        'linked_file_public_id' => [
            'type' => 'integer',
            'required' => true,
            'description' => 'The unique identifier of the linked file.',
        ],
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official Shortcut API schema.',
        ],
    ];
    protected const METHOD = 'PUT';
    protected const PATH = '/api/v3/linked-files/{linked-file-public-id}';
    protected const PATH_PARAMS = [
        'linked-file-public-id' => 'linked_file_public_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'json';
}
