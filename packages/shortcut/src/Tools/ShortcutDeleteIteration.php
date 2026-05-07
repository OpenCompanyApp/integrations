<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * Delete Iteration.
 *
 * Maps to the official Shortcut endpoint DELETE /api/v3/iterations/{iteration-public-id}.
 */
class ShortcutDeleteIteration extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_delete_iteration';
    protected const DESCRIPTION = 'Delete Iteration

Official Shortcut endpoint: DELETE /api/v3/iterations/{iteration-public-id}.';
    protected const PARAMETERS = [
        'iteration_public_id' => [
            'type' => 'integer',
            'required' => true,
            'description' => 'The unique ID of the Iteration.',
        ],
    ];
    protected const METHOD = 'DELETE';
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
