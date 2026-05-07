<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * List Objective Epics.
 *
 * Maps to the official Shortcut endpoint GET /api/v3/objectives/{objective-public-id}/epics.
 */
class ShortcutListObjectiveEpics extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_list_objective_epics';
    protected const DESCRIPTION = 'List Objective Epics

Official Shortcut endpoint: GET /api/v3/objectives/{objective-public-id}/epics.';
    protected const PARAMETERS = [
        'objective_public_id' => [
            'type' => 'integer',
            'required' => true,
            'description' => 'The ID of the Objective.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v3/objectives/{objective-public-id}/epics';
    protected const PATH_PARAMS = [
        'objective-public-id' => 'objective_public_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}
