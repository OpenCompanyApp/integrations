<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * Update Milestone.
 *
 * Maps to the official Shortcut endpoint PUT /api/v3/milestones/{milestone-public-id}.
 */
class ShortcutUpdateMilestone extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_update_milestone';
    protected const DESCRIPTION = 'Update Milestone

Official Shortcut endpoint: PUT /api/v3/milestones/{milestone-public-id}.';
    protected const PARAMETERS = [
        'milestone_public_id' => [
            'type' => 'integer',
            'required' => true,
            'description' => 'The ID of the Milestone.',
        ],
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official Shortcut API schema.',
        ],
    ];
    protected const METHOD = 'PUT';
    protected const PATH = '/api/v3/milestones/{milestone-public-id}';
    protected const PATH_PARAMS = [
        'milestone-public-id' => 'milestone_public_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'json';
}
