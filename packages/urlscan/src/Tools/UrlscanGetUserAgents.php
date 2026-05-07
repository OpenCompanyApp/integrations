<?php

namespace OpenCompany\Integrations\Urlscan\Tools;

/**
 * Available User Agents.
 *
 * Maps to the official urlscan.io endpoint GET /api/v1/userAgents.
 */
class UrlscanGetUserAgents extends AbstractUrlscanTool
{
    protected const NAME = 'urlscan_get_user_agents';
    protected const DESCRIPTION = 'Available User Agents

Official urlscan.io endpoint: GET /api/v1/userAgents.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/userAgents';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const BODY_REQUIRED = false;
}
