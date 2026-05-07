<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * Delete Milestone.
 *
 * Maps to the official Shortcut endpoint DELETE /api/v3/milestones/{milestone-public-id}.
 */
class ShortcutDeleteMilestone extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_delete_milestone';
    protected const DESCRIPTION = 'Delete Milestone

Official Shortcut endpoint: DELETE /api/v3/milestones/{milestone-public-id}.';
    protected const PARAMETERS = [
        'milestone_public_id' => [
            'type' => 'integer',
            'required' => true,
            'description' => 'The ID of the Milestone.',
        ],
    ];
    protected const METHOD = 'DELETE';
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
