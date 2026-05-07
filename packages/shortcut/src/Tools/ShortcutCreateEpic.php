<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * Create Epic.
 *
 * Maps to the official Shortcut endpoint POST /api/v3/epics.
 */
class ShortcutCreateEpic extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_create_epic';
    protected const DESCRIPTION = 'Create Epic

Official Shortcut endpoint: POST /api/v3/epics.';
    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official Shortcut API schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/api/v3/epics';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'json';
}
