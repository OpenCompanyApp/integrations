<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Cross margin collateral ratio (MARKET_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/margin/crossMarginCollateralRatio.
 */
class BinanceGetSapiV1MarginCrossmargincollateralratio extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_margin_crossmargincollateralratio';
    protected const DESCRIPTION = 'Cross margin collateral ratio (MARKET_DATA)

Weight(IP): 100

Official Binance Spot endpoint: GET /sapi/v1/margin/crossMarginCollateralRatio.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/sapi/v1/margin/crossMarginCollateralRatio';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'api_key';
}
