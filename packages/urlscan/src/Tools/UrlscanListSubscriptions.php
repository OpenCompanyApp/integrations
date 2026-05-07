<?php

namespace OpenCompany\Integrations\Urlscan\Tools;

/**
 * Subscriptions.
 *
 * Maps to the official urlscan.io endpoint GET /api/v1/user/subscriptions/.
 */
class UrlscanListSubscriptions extends AbstractUrlscanTool
{
    protected const NAME = 'urlscan_list_subscriptions';
    protected const DESCRIPTION = 'Subscriptions

Official urlscan.io endpoint: GET /api/v1/user/subscriptions/.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/user/subscriptions/';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const BODY_REQUIRED = false;
}
