<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * Create Story From Template.
 *
 * Maps to the official Shortcut endpoint POST /api/v3/stories/from-template.
 */
class ShortcutCreateStoryFromTemplate extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_create_story_from_template';
    protected const DESCRIPTION = 'Create Story From Template

Official Shortcut endpoint: POST /api/v3/stories/from-template.';
    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request parameters for creating a story from a story template. These parameters are merged with the values derived from the template.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/api/v3/stories/from-template';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'json';
}
