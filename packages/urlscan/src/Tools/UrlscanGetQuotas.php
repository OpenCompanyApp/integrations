<?php

namespace OpenCompany\Integrations\Urlscan\Tools;

/**
 * API Quotas.
 *
 * Maps to the official urlscan.io endpoint GET /api/v1/quotas.
 */
class UrlscanGetQuotas extends AbstractUrlscanTool
{
    protected const NAME = 'urlscan_get_quotas';
    protected const DESCRIPTION = 'API Quotas

Official urlscan.io endpoint: GET /api/v1/quotas.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/quotas';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const BODY_REQUIRED = false;
}
