<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * Create Label.
 *
 * Maps to the official Shortcut endpoint POST /api/v3/labels.
 */
class ShortcutCreateLabel extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_create_label';
    protected const DESCRIPTION = 'Create Label

Official Shortcut endpoint: POST /api/v3/labels.';
    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request parameters for creating a Label on a Shortcut Story.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/api/v3/labels';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'json';
}
