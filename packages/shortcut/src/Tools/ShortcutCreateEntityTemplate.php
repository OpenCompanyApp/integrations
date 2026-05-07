<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * Create Entity Template.
 *
 * Maps to the official Shortcut endpoint POST /api/v3/entity-templates.
 */
class ShortcutCreateEntityTemplate extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_create_entity_template';
    protected const DESCRIPTION = 'Create Entity Template

Official Shortcut endpoint: POST /api/v3/entity-templates.';
    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request parameters for creating an entirely new entity template.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/api/v3/entity-templates';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'json';
}
