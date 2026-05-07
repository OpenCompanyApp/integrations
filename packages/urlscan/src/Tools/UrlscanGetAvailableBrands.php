<?php

namespace OpenCompany\Integrations\Urlscan\Tools;

/**
 * Available Brands.
 *
 * Maps to the official urlscan.io endpoint GET /api/v1/pro/availableBrands.
 */
class UrlscanGetAvailableBrands extends AbstractUrlscanTool
{
    protected const NAME = 'urlscan_get_available_brands';
    protected const DESCRIPTION = 'Available Brands

Official urlscan.io endpoint: GET /api/v1/pro/availableBrands.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/pro/availableBrands';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const BODY_REQUIRED = false;
}
