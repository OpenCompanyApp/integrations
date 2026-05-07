<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * Get Key Result.
 *
 * Maps to the official Shortcut endpoint GET /api/v3/key-results/{key-result-public-id}.
 */
class ShortcutGetKeyResult extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_get_key_result';
    protected const DESCRIPTION = 'Get Key Result

Official Shortcut endpoint: GET /api/v3/key-results/{key-result-public-id}.';
    protected const PARAMETERS = [
        'key_result_public_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The ID of the Key Result.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v3/key-results/{key-result-public-id}';
    protected const PATH_PARAMS = [
        'key-result-public-id' => 'key_result_public_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}
