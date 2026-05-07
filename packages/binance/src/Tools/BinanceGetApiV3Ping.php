<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Test Connectivity.
 *
 * Maps to the official Binance Spot endpoint GET /api/v3/ping.
 */
class BinanceGetApiV3Ping extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_api_v3_ping';
    protected const DESCRIPTION = 'Test Connectivity

Test connectivity to the Rest API. Weight(IP): 1

Official Binance Spot endpoint: GET /api/v3/ping.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v3/ping';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'public';
}
