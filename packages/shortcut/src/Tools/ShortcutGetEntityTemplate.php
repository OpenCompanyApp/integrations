<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * Get Entity Template.
 *
 * Maps to the official Shortcut endpoint GET /api/v3/entity-templates/{entity-template-public-id}.
 */
class ShortcutGetEntityTemplate extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_get_entity_template';
    protected const DESCRIPTION = 'Get Entity Template

Official Shortcut endpoint: GET /api/v3/entity-templates/{entity-template-public-id}.';
    protected const PARAMETERS = [
        'entity_template_public_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The unique ID of the entity template.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v3/entity-templates/{entity-template-public-id}';
    protected const PATH_PARAMS = [
        'entity-template-public-id' => 'entity_template_public_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}
