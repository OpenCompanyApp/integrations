<?php

namespace OpenCompany\Integrations\Urlscan\Tools;

/**
 * Create Channel.
 *
 * Maps to the official urlscan.io endpoint POST /api/v1/user/channels/.
 */
class UrlscanCreateChannel extends AbstractUrlscanTool
{
    protected const NAME = 'urlscan_create_channel';
    protected const DESCRIPTION = 'Create Channel

Official urlscan.io endpoint: POST /api/v1/user/channels/.';
    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'JSON request body matching the official urlscan.io OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/user/channels/';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const BODY_REQUIRED = false;
}
