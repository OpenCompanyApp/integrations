<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * System Status (System).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/system/status.
 */
class BinanceGetSapiV1SystemStatus extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_system_status';
    protected const DESCRIPTION = 'System Status (System)

Fetch system status. Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/system/status.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/sapi/v1/system/status';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'public';
}
