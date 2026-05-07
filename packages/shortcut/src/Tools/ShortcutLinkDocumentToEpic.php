<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * Link Document to Epic.
 *
 * Maps to the official Shortcut endpoint PUT /api/v3/documents/{doc-public-id}/epics/{epic-public-id}.
 */
class ShortcutLinkDocumentToEpic extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_link_document_to_epic';
    protected const DESCRIPTION = 'Link Document to Epic

Official Shortcut endpoint: PUT /api/v3/documents/{doc-public-id}/epics/{epic-public-id}.';
    protected const PARAMETERS = [
        'doc_public_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The public ID of the Document.',
        ],
        'epic_public_id' => [
            'type' => 'integer',
            'required' => true,
            'description' => 'The public ID of the Epic.',
        ],
    ];
    protected const METHOD = 'PUT';
    protected const PATH = '/api/v3/documents/{doc-public-id}/epics/{epic-public-id}';
    protected const PATH_PARAMS = [
        'doc-public-id' => 'doc_public_id',
        'epic-public-id' => 'epic_public_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}
