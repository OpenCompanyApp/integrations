<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * Create Linked File.
 *
 * Maps to the official Shortcut endpoint POST /api/v3/linked-files.
 */
class ShortcutCreateLinkedFile extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_create_linked_file';
    protected const DESCRIPTION = 'Create Linked File

Official Shortcut endpoint: POST /api/v3/linked-files.';
    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official Shortcut API schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/api/v3/linked-files';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'json';
}
