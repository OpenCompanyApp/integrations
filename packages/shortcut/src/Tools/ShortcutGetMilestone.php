<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * Get Milestone.
 *
 * Maps to the official Shortcut endpoint GET /api/v3/milestones/{milestone-public-id}.
 */
class ShortcutGetMilestone extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_get_milestone';
    protected const DESCRIPTION = 'Get Milestone

Official Shortcut endpoint: GET /api/v3/milestones/{milestone-public-id}.';
    protected const PARAMETERS = [
        'milestone_public_id' => [
            'type' => 'integer',
            'required' => true,
            'description' => 'The ID of the Milestone.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v3/milestones/{milestone-public-id}';
    protected const PATH_PARAMS = [
        'milestone-public-id' => 'milestone_public_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}
