<?php

namespace OpenCompany\Integrations\CoinMarketCap\Tools;

/**
 * CoinMarketCap 100 Index Latest.
 *
 * Maps to the official CoinMarketCap endpoint GET /v3/index/cmc100-latest.
 */
class CoinMarketCapGetV3IndexCmc100Latest extends AbstractCoinMarketCapTool
{
    protected const NAME = 'coinmarketcap_get_v3_index_cmc100_latest';
    protected const DESCRIPTION = 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: GET /v3/index/cmc100-latest.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/v3/index/cmc100-latest';
    protected const QUERY_PARAMS = [];
    protected const BODY_REQUIRED = false;
}
