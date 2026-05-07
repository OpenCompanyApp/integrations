<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * Create Objective.
 *
 * Maps to the official Shortcut endpoint POST /api/v3/objectives.
 */
class ShortcutCreateObjective extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_create_objective';
    protected const DESCRIPTION = 'Create Objective

Official Shortcut endpoint: POST /api/v3/objectives.';
    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official Shortcut API schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/api/v3/objectives';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'json';
}
