<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Query Sub-account Transaction Statistics (For Master Account).
 *
 * Maps to the official Binance Spot endpoint GET /sapi/v1/sub-account/transaction-statistics.
 */
class BinanceGetSapiV1SubAccountTransactionStatistics extends AbstractBinanceTool
{
    protected const NAME = 'binance_get_sapi_v1_sub_account_transaction_statistics';
    protected const DESCRIPTION = 'Query Sub-account Transaction Statistics (For Master Account)

Query Sub-account Transaction statistics (For Master Account). Weight(UID): 60

Official Binance Spot endpoint: GET /sapi/v1/sub-account/transaction-statistics.';
    protected const PARAMETERS = [
        'email' => [
            'type' => 'string',
            'required' => true,
            'description' => 'query parameter `email`.',
        ],
        'recv_window' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'The value cannot be greater than 60000',
        ],
        'timestamp' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'UTC timestamp in ms',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/sapi/v1/sub-account/transaction-statistics';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'email' => 'email',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
