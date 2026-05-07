<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * Load Tiptap Document JSON.
 *
 * Maps to the official Shortcut endpoint GET /api/v3/documents/{doc-public-id}/tiptap-load.
 */
class ShortcutLoadTiptapDocumentJSON extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_load_tiptap_document_json';
    protected const DESCRIPTION = 'Load Tiptap Document JSON

Official Shortcut endpoint: GET /api/v3/documents/{doc-public-id}/tiptap-load.';
    protected const PARAMETERS = [
        'doc_public_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The Doc\'s public ID',
        ],
        'content_format' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Format of the content to return. Defaults to \'markdown\'. If \'html\', includes HTML content in response.',
            'enum' => [
                'markdown',
                'html',
            ],
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v3/documents/{doc-public-id}/tiptap-load';
    protected const PATH_PARAMS = [
        'doc-public-id' => 'doc_public_id',
    ];
    protected const QUERY_PARAMS = [
        'content_format' => 'content_format',
    ];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}
