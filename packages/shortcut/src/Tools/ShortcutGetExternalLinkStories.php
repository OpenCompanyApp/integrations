<?php

namespace OpenCompany\Integrations\Shortcut\Tools;

/**
 * Get External Link Stories.
 *
 * Maps to the official Shortcut endpoint GET /api/v3/external-link/stories.
 */
class ShortcutGetExternalLinkStories extends AbstractShortcutTool
{
    protected const NAME = 'shortcut_get_external_link_stories';
    protected const DESCRIPTION = 'Get External Link Stories

Official Shortcut endpoint: GET /api/v3/external-link/stories.';
    protected const PARAMETERS = [
        'external_link' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The external link associated with one or more stories.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v3/external-link/stories';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'external_link' => 'external_link',
    ];
    protected const FORM_PARAMS = [];
    protected const FORM_REQUIRED_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}
