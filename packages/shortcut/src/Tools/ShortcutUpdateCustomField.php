<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * Update Custom Field.
 *
 * Maps to the official Shortcut endpoint PUT /api/v3/custom-fields/{custom-field-public-id}.
 */
class ShortcutUpdateCustomField extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_update_custom_field';
    protected const DESCRIPTION = 'Update Custom Field

Official Shortcut endpoint: PUT /api/v3/custom-fields/{custom-field-public-id}.';
    protected const PARAMETERS = [
        'custom_field_public_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The unique ID of the CustomField.',
        ],
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official Shortcut API schema.',
        ],
    ];
    protected const METHOD = 'PUT';
    protected const PATH = '/api/v3/custom-fields/{custom-field-public-id}';
    protected const PATH_PARAMS = [
        'custom-field-public-id' => 'custom_field_public_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'json';
}
