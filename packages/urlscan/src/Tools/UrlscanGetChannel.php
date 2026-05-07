<?php

namespace OpenCompany\Integrations\Urlscan\Tools;

/**
 * Channel Search Results.
 *
 * Maps to the official urlscan.io endpoint GET /api/v1/user/channels/{channelId}.
 */
class UrlscanGetChannel extends AbstractUrlscanTool
{
    protected const NAME = 'urlscan_get_channel';
    protected const DESCRIPTION = 'Channel Search Results

Official urlscan.io endpoint: GET /api/v1/user/channels/{channelId}.';
    protected const PARAMETERS = [
        'channel_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'channelId',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/user/channels/{channelId}';
    protected const PATH_PARAMS = [
        'channelId' => 'channel_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const BODY_REQUIRED = false;
}
