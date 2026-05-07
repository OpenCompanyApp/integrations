<?php

namespace OpenCompany\Integrations\CoinMarketCap\Tools;

/**
 * Altcoin Season Index Latest.
 *
 * Maps to the official CoinMarketCap endpoint GET /v1/altcoin-season-index/latest.
 */
class CoinMarketCapGetV1AltcoinSeasonIndexLatest extends AbstractCoinMarketCapTool
{
    protected const NAME = 'coinmarketcap_get_v1_altcoin_season_index_latest';
    protected const DESCRIPTION = 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v1/altcoin-season-index/latest.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/altcoin-season-index/latest';
    protected const QUERY_PARAMS = [];
    protected const BODY_REQUIRED = false;
}
