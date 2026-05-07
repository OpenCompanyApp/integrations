<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * List Milestone Epics.
 *
 * Maps to the official Shortcut endpoint GET /api/v3/milestones/{milestone-public-id}/epics.
 */
class ShortcutListMilestoneEpics extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_list_milestone_epics';
    protected const DESCRIPTION = 'List Milestone Epics

Official Shortcut endpoint: GET /api/v3/milestones/{milestone-public-id}/epics.';
    protected const PARAMETERS = [
        'milestone_public_id' => [
            'type' => 'integer',
            'required' => true,
            'description' => 'The ID of the Milestone.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v3/milestones/{milestone-public-id}/epics';
    protected const PATH_PARAMS = [
        'milestone-public-id' => 'milestone_public_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}
