<?php

namespace OpenCompany\Integrations\Urlscan\Tools;

/**
 * Update Channel.
 *
 * Maps to the official urlscan.io endpoint PUT /api/v1/user/channels/{channelId}.
 */
class UrlscanUpdateChannel extends AbstractUrlscanTool
{
    protected const NAME = 'urlscan_update_channel';
    protected const DESCRIPTION = 'Update Channel

Official urlscan.io endpoint: PUT /api/v1/user/channels/{channelId}.';
    protected const PARAMETERS = [
        'channel_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'channelId',
        ],
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'JSON request body matching the official urlscan.io OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'PUT';
    protected const PATH = '/api/v1/user/channels/{channelId}';
    protected const PATH_PARAMS = [
        'channelId' => 'channel_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const BODY_REQUIRED = false;
}
