<?php

namespace OpenCompany\Integrations\CoinMarketCap\Tools;

/**
 * Batch query tokens.
 *
 * Maps to the official CoinMarketCap endpoint POST /v1/dex/tokens/batch-query.
 */
class CoinMarketCapPostV1DexTokensBatchQuery extends AbstractCoinMarketCapTool
{
    protected const NAME = 'coinmarketcap_post_v1_dex_tokens_batch_query';
    protected const DESCRIPTION = 'Fetch the complete documentation index at: https://pro.coinmarketcap.com/llms.txt

Official CoinMarketCap endpoint: POST /v1/dex/tokens/batch-query.';
    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'JSON request body matching the CoinMarketCap API schema for this endpoint.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/v1/dex/tokens/batch-query';
    protected const QUERY_PARAMS = [];
    protected const BODY_REQUIRED = true;
}
