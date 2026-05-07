<?php

namespace OpenCompany\Integrations\Urlscan\Tools;

/**
 * Live Scanners.
 *
 * Maps to the official urlscan.io endpoint GET /api/v1/livescan/scanners/.
 */
class UrlscanGetLivescanScanners extends AbstractUrlscanTool
{
    protected const NAME = 'urlscan_get_livescan_scanners';
    protected const DESCRIPTION = 'Live Scanners

Official urlscan.io endpoint: GET /api/v1/livescan/scanners/.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/livescan/scanners/';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const BODY_REQUIRED = false;
}
