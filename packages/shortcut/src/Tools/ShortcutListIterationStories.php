<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * List Iteration Stories.
 *
 * Maps to the official Shortcut endpoint GET /api/v3/iterations/{iteration-public-id}/stories.
 */
class ShortcutListIterationStories extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_list_iteration_stories';
    protected const DESCRIPTION = 'List Iteration Stories

Official Shortcut endpoint: GET /api/v3/iterations/{iteration-public-id}/stories.';
    protected const PARAMETERS = [
        'iteration_public_id' => [
            'type' => 'integer',
            'required' => true,
            'description' => 'The unique ID of the Iteration.',
        ],
        'includes_description' => [
            'type' => 'boolean',
            'required' => false,
            'description' => 'A true/false boolean indicating whether to return Stories with their descriptions.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v3/iterations/{iteration-public-id}/stories';
    protected const PATH_PARAMS = [
        'iteration-public-id' => 'iteration_public_id',
    ];
    protected const QUERY_PARAMS = [
        'includes_description' => 'includes_description',
    ];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}
