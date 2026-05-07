<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Query Liability Coin Leverage Bracket in Cross Margin Pro Mode (MARKET_DATA).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/margin/leverageBracket.
 */
class BinanceGetSapiV1MarginLeveragebracket extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_margin_leveragebracket';
    protected const DESCRIPTION = 'Query Liability Coin Leverage Bracket in Cross Margin Pro Mode (MARKET_DATA)

Liability Coin Leverage Bracket in Cross Margin Pro Mode Weight(IP): 1

Official Binance Spot endpoint: GET /sapi/v1/margin/leverageBracket.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/sapi/v1/margin/leverageBracket';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'api_key';
}
