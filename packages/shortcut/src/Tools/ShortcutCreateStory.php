<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * Create Story.
 *
 * Maps to the official Shortcut endpoint POST /api/v3/stories.
 */
class ShortcutCreateStory extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_create_story';
    protected const DESCRIPTION = 'Create Story

Official Shortcut endpoint: POST /api/v3/stories.';
    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request parameters for creating a story.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/api/v3/stories';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'json';
}
