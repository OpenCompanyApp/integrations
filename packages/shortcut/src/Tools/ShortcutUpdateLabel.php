<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * Update Label.
 *
 * Maps to the official Shortcut endpoint PUT /api/v3/labels/{label-public-id}.
 */
class ShortcutUpdateLabel extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_update_label';
    protected const DESCRIPTION = 'Update Label

Official Shortcut endpoint: PUT /api/v3/labels/{label-public-id}.';
    protected const PARAMETERS = [
        'label_public_id' => [
            'type' => 'integer',
            'required' => true,
            'description' => 'The unique ID of the Label you wish to update.',
        ],
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official Shortcut API schema.',
        ],
    ];
    protected const METHOD = 'PUT';
    protected const PATH = '/api/v3/labels/{label-public-id}';
    protected const PATH_PARAMS = [
        'label-public-id' => 'label_public_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'json';
}
