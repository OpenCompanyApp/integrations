<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * Get Epic Health.
 *
 * Maps to the official Shortcut endpoint GET /api/v3/epics/{epic-public-id}/health.
 */
class ShortcutGetEpicHealth extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_get_epic_health';
    protected const DESCRIPTION = 'Get Epic Health

Official Shortcut endpoint: GET /api/v3/epics/{epic-public-id}/health.';
    protected const PARAMETERS = [
        'epic_public_id' => [
            'type' => 'integer',
            'required' => true,
            'description' => 'The unique ID of the Epic.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v3/epics/{epic-public-id}/health';
    protected const PATH_PARAMS = [
        'epic-public-id' => 'epic_public_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}
