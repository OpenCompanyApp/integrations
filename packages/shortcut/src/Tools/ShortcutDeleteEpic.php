<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * Delete Epic.
 *
 * Maps to the official Shortcut endpoint DELETE /api/v3/epics/{epic-public-id}.
 */
class ShortcutDeleteEpic extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_delete_epic';
    protected const DESCRIPTION = 'Delete Epic

Official Shortcut endpoint: DELETE /api/v3/epics/{epic-public-id}.';
    protected const PARAMETERS = [
        'epic_public_id' => [
            'type' => 'integer',
            'required' => true,
            'description' => 'The unique ID of the Epic.',
        ],
    ];
    protected const METHOD = 'DELETE';
    protected const PATH = '/api/v3/epics/{epic-public-id}';
    protected const PATH_PARAMS = [
        'epic-public-id' => 'epic_public_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}
