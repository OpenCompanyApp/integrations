<?php

namespace OpenCompany\Integrations\Urlscan\Tools;

/**
 * Brands.
 *
 * Maps to the official urlscan.io endpoint GET /api/v1/pro/brands.
 */
class UrlscanGetBrandSummary extends AbstractUrlscanTool
{
    protected const NAME = 'urlscan_get_brand_summary';
    protected const DESCRIPTION = 'Brands

Official urlscan.io endpoint: GET /api/v1/pro/brands.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/pro/brands';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const BODY_REQUIRED = false;
}
