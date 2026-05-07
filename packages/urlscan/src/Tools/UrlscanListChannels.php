<?php

namespace OpenCompany\Integrations\Urlscan\Tools;

/**
 * Channels.
 *
 * Maps to the official urlscan.io endpoint GET /api/v1/user/channels/.
 */
class UrlscanListChannels extends AbstractUrlscanTool
{
    protected const NAME = 'urlscan_list_channels';
    protected const DESCRIPTION = 'Channels

Official urlscan.io endpoint: GET /api/v1/user/channels/.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/user/channels/';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const BODY_REQUIRED = false;
}
