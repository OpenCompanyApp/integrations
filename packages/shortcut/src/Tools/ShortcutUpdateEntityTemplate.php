<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * Update Entity Template.
 *
 * Maps to the official Shortcut endpoint PUT /api/v3/entity-templates/{entity-template-public-id}.
 */
class ShortcutUpdateEntityTemplate extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_update_entity_template';
    protected const DESCRIPTION = 'Update Entity Template

Official Shortcut endpoint: PUT /api/v3/entity-templates/{entity-template-public-id}.';
    protected const PARAMETERS = [
        'entity_template_public_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The unique ID of the template to be updated.',
        ],
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request parameters for changing either a template\'s name or any of the attributes it is designed to pre-populate.',
        ],
    ];
    protected const METHOD = 'PUT';
    protected const PATH = '/api/v3/entity-templates/{entity-template-public-id}';
    protected const PATH_PARAMS = [
        'entity-template-public-id' => 'entity_template_public_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'json';
}
