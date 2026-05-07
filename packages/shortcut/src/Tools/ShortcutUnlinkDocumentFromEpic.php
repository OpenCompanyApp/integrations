<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * Unlink Document from Epic.
 *
 * Maps to the official Shortcut endpoint DELETE /api/v3/documents/{doc-public-id}/epics/{epic-public-id}.
 */
class ShortcutUnlinkDocumentFromEpic extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_unlink_document_from_epic';
    protected const DESCRIPTION = 'Unlink Document from Epic

Official Shortcut endpoint: DELETE /api/v3/documents/{doc-public-id}/epics/{epic-public-id}.';
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
    protected const METHOD = 'DELETE';
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
