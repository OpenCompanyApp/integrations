<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * Update Doc.
 *
 * Maps to the official Shortcut endpoint PUT /api/v3/documents/{doc-public-id}.
 */
class ShortcutUpdateDoc extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_update_doc';
    protected const DESCRIPTION = 'Update Doc

Official Shortcut endpoint: PUT /api/v3/documents/{doc-public-id}.';
    protected const PARAMETERS = [
        'doc_public_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The Doc\'s public ID',
        ],
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official Shortcut API schema.',
        ],
    ];
    protected const METHOD = 'PUT';
    protected const PATH = '/api/v3/documents/{doc-public-id}';
    protected const PATH_PARAMS = [
        'doc-public-id' => 'doc_public_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'json';
}
