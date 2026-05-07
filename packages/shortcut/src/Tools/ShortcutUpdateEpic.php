<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * Update Epic.
 *
 * Maps to the official Shortcut endpoint PUT /api/v3/epics/{epic-public-id}.
 */
class ShortcutUpdateEpic extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_update_epic';
    protected const DESCRIPTION = 'Update Epic

Official Shortcut endpoint: PUT /api/v3/epics/{epic-public-id}.';
    protected const PARAMETERS = [
        'epic_public_id' => [
            'type' => 'integer',
            'required' => true,
            'description' => 'The unique ID of the Epic.',
        ],
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official Shortcut API schema.',
        ],
    ];
    protected const METHOD = 'PUT';
    protected const PATH = '/api/v3/epics/{epic-public-id}';
    protected const PATH_PARAMS = [
        'epic-public-id' => 'epic_public_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'json';
}
