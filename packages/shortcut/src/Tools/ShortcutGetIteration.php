<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * Get Iteration.
 *
 * Maps to the official Shortcut endpoint GET /api/v3/iterations/{iteration-public-id}.
 */
class ShortcutGetIteration extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_get_iteration';
    protected const DESCRIPTION = 'Get Iteration

Official Shortcut endpoint: GET /api/v3/iterations/{iteration-public-id}.';
    protected const PARAMETERS = [
        'iteration_public_id' => [
            'type' => 'integer',
            'required' => true,
            'description' => 'The unique ID of the Iteration.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v3/iterations/{iteration-public-id}';
    protected const PATH_PARAMS = [
        'iteration-public-id' => 'iteration_public_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}
