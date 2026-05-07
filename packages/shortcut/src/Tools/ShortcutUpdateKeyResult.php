<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * Update Key Result.
 *
 * Maps to the official Shortcut endpoint PUT /api/v3/key-results/{key-result-public-id}.
 */
class ShortcutUpdateKeyResult extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_update_key_result';
    protected const DESCRIPTION = 'Update Key Result

Official Shortcut endpoint: PUT /api/v3/key-results/{key-result-public-id}.';
    protected const PARAMETERS = [
        'key_result_public_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The ID of the Key Result.',
        ],
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official Shortcut API schema.',
        ],
    ];
    protected const METHOD = 'PUT';
    protected const PATH = '/api/v3/key-results/{key-result-public-id}';
    protected const PATH_PARAMS = [
        'key-result-public-id' => 'key_result_public_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'json';
}
