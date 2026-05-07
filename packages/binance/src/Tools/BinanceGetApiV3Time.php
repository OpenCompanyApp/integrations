<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Check Server Time.
 *
 * Maps to the official Binance Spot endpoint GET /api/v3/time.
 */
class BinanceGetApiV3Time extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_api_v3_time';
    protected const DESCRIPTION = 'Check Server Time

Test connectivity to the Rest API and get the current server time. Weight(IP): 1

Official Binance Spot endpoint: GET /api/v3/time.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v3/time';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'public';
}
