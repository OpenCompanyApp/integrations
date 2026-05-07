<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * BNB Transfer (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint POST /sapi/v1/portfolio/bnb-transfer.
 */
class BinancePostSapiV1PortfolioBnbTransfer extends AbstractBinanceTool
{
    protected const NAME = 'binance_post_sapi_v1_portfolio_bnb_transfer';
    protected const DESCRIPTION = 'BNB Transfer (USER_DATA)

BNB transfer can be between Margin Account and USDM Account Weight(IP): 1500

Official Binance Spot endpoint: POST /sapi/v1/portfolio/bnb-transfer.';
    protected const PARAMETERS = [
        'transfer_side' => [
            'type' => 'string',
            'required' => true,
            'description' => 'query parameter `transferSide`.',
            'enum' => [
                'TO_UM',
                'FROM_UM',
            ],
        ],
        'amount' => [
            'type' => 'number',
            'required' => true,
            'description' => 'query parameter `amount`.',
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
    protected const METHOD = 'POST';
    protected const PATH = '/sapi/v1/portfolio/bnb-transfer';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'transferSide' => 'transfer_side',
        'amount' => 'amount',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
