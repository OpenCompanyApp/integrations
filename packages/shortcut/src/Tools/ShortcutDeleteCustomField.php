<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * Delete Custom Field.
 *
 * Maps to the official Shortcut endpoint DELETE /api/v3/custom-fields/{custom-field-public-id}.
 */
class ShortcutDeleteCustomField extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_delete_custom_field';
    protected const DESCRIPTION = 'Delete Custom Field

Official Shortcut endpoint: DELETE /api/v3/custom-fields/{custom-field-public-id}.';
    protected const PARAMETERS = [
        'custom_field_public_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The unique ID of the CustomField.',
        ],
    ];
    protected const METHOD = 'DELETE';
    protected const PATH = '/api/v3/custom-fields/{custom-field-public-id}';
    protected const PATH_PARAMS = [
        'custom-field-public-id' => 'custom_field_public_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}
