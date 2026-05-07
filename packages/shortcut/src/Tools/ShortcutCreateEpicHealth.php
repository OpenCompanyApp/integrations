<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * Create Epic Health.
 *
 * Maps to the official Shortcut endpoint POST /api/v3/epics/{epic-public-id}/health.
 */
class ShortcutCreateEpicHealth extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_create_epic_health';
    protected const DESCRIPTION = 'Create Epic Health

Official Shortcut endpoint: POST /api/v3/epics/{epic-public-id}/health.';
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
    protected const METHOD = 'POST';
    protected const PATH = '/api/v3/epics/{epic-public-id}/health';
    protected const PATH_PARAMS = [
        'epic-public-id' => 'epic_public_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'json';
}
