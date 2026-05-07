<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * List Document Epics.
 *
 * Maps to the official Shortcut endpoint GET /api/v3/documents/{doc-public-id}/epics.
 */
class ShortcutListDocumentEpics extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_list_document_epics';
    protected const DESCRIPTION = 'List Document Epics

Official Shortcut endpoint: GET /api/v3/documents/{doc-public-id}/epics.';
    protected const PARAMETERS = [
        'doc_public_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The public ID of the Document.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v3/documents/{doc-public-id}/epics';
    protected const PATH_PARAMS = [
        'doc-public-id' => 'doc_public_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}
