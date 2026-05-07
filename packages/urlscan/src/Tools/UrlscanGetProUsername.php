<?php

namespace OpenCompany\Integrations\Urlscan\Tools;

/**
 * User Information.
 *
 * Maps to the official urlscan.io endpoint GET /api/v1/pro/username.
 */
class UrlscanGetProUsername extends AbstractUrlscanTool
{
    protected const NAME = 'urlscan_get_pro_username';
    protected const DESCRIPTION = 'User Information

Official urlscan.io endpoint: GET /api/v1/pro/username.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/pro/username';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const BODY_REQUIRED = false;
}
