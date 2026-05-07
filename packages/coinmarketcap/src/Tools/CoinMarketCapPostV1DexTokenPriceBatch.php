<?php

namespace OpenCompany\Integrations\CoinMarketCap\Tools;

/**
 * Batch get token prices.
 *
 * Maps to the official CoinMarketCap endpoint POST /v1/dex/token/price/batch.
 */
class CoinMarketCapPostV1DexTokenPriceBatch extends AbstractCoinMarketCapTool
{
    protected const NAME = 'coinmarketcap_post_v1_dex_token_price_batch';
    protected const DESCRIPTION = 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: POST /v1/dex/token/price/batch.';
    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'JSON request body matching the CoinMarketCap API schema for this endpoint.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/v1/dex/token/price/batch';
    protected const QUERY_PARAMS = [];
    protected const BODY_REQUIRED = true;
}
