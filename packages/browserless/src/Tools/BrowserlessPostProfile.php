<?php

namespace OpenCompany\Integrations\Browserless\Tools;

/**
 * /profile.
 *
 * Maps to the official Browserless endpoint POST /profile.
 */
class BrowserlessPostProfile extends AbstractBrowserlessTool
{
    protected const NAME = 'browserless_post_profile';
    protected const DESCRIPTION = '/profile

Official Browserless endpoint: POST /profile.';
    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'JSON request body matching the Browserless OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/profile';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const OPTIONAL_PATH_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}
