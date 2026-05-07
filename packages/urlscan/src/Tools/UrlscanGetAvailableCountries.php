<?php

namespace OpenCompany\Integrations\Urlscan\Tools;

/**
 * Available Countries.
 *
 * Maps to the official urlscan.io endpoint GET /api/v1/availableCountries.
 */
class UrlscanGetAvailableCountries extends AbstractUrlscanTool
{
    protected const NAME = 'urlscan_get_available_countries';
    protected const DESCRIPTION = 'Available Countries

Official urlscan.io endpoint: GET /api/v1/availableCountries.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/availableCountries';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const BODY_REQUIRED = false;
}
