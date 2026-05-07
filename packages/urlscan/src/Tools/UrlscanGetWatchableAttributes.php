<?php

namespace OpenCompany\Integrations\Urlscan\Tools;

/**
 * Get Watchable Attributes.
 *
 * Maps to the official urlscan.io endpoint GET /api/v1/user/watchableAttributes.
 */
class UrlscanGetWatchableAttributes extends AbstractUrlscanTool
{
    protected const NAME = 'urlscan_get_watchable_attributes';
    protected const DESCRIPTION = 'Get Watchable Attributes

Official urlscan.io endpoint: GET /api/v1/user/watchableAttributes.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/user/watchableAttributes';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const BODY_REQUIRED = false;
}
