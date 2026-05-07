<?php

namespace OpenCompany\Integrations\Browserless\Tools;

/**
 * /session/connect/*.
 *
 * Maps to the official Browserless endpoint GET /session/connect/*.
 */
class BrowserlessGetSessionConnectWildcard extends AbstractBrowserlessTool
{
    protected const NAME = 'browserless_get_session_connect_wildcard';
    protected const DESCRIPTION = '/session/connect/*

Official Browserless endpoint: GET /session/connect/*.';
    protected const PARAMETERS = [
        'path_suffix' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Dynamic Browserless path suffix for this wildcard route.',
        ],
        'launch' => [
            'type' => 'string',
            'required' => false,
            'description' => 'launch',
        ],
        'replay' => [
            'type' => 'boolean',
            'required' => false,
            'description' => 'replay',
        ],
        'timeout' => [
            'type' => 'number',
            'required' => false,
            'description' => 'timeout',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/session/connect/{path_suffix}';
    protected const PATH_PARAMS = [
        'path_suffix' => 'path_suffix',
    ];
    protected const QUERY_PARAMS = [
        'launch' => 'launch',
        'replay' => 'replay',
        'timeout' => 'timeout',
    ];
    protected const OPTIONAL_PATH_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}
