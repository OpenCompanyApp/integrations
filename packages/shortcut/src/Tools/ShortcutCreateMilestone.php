<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * Create Milestone.
 *
 * Maps to the official Shortcut endpoint POST /api/v3/milestones.
 */
class ShortcutCreateMilestone extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_create_milestone';
    protected const DESCRIPTION = 'Create Milestone

Official Shortcut endpoint: POST /api/v3/milestones.';
    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official Shortcut API schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/api/v3/milestones';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'json';
}
