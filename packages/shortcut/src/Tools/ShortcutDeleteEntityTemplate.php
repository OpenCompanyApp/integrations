<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * Delete Entity Template.
 *
 * Maps to the official Shortcut endpoint DELETE /api/v3/entity-templates/{entity-template-public-id}.
 */
class ShortcutDeleteEntityTemplate extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_delete_entity_template';
    protected const DESCRIPTION = 'Delete Entity Template

Official Shortcut endpoint: DELETE /api/v3/entity-templates/{entity-template-public-id}.';
    protected const PARAMETERS = [
        'entity_template_public_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The unique ID of the entity template.',
        ],
    ];
    protected const METHOD = 'DELETE';
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
