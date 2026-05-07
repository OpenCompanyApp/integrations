<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Withdraw (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint POST /sapi/v1/capital/withdraw/apply.
 */
class BinancePostSapiV1CapitalWithdrawApply extends AbstractBinanceTool
{
    protected const NAME = 'binance_post_sapi_v1_capital_withdraw_apply';
    protected const DESCRIPTION = 'Withdraw (USER_DATA)

Submit a withdraw request. - If `network` not send, return with default network of the coin. - You can get `network` and `isDefault` in `networkList` of a coin in the response of `Get /sapi/v1/capital/config/getall (HMAC SHA256)`. Weight(IP): 1

Official Binance Spot endpoint: POST /sapi/v1/capital/withdraw/apply.';
    protected const PARAMETERS = [
        'coin' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Coin name',
        ],
        'withdraw_order_id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Client id for withdraw',
        ],
        'network' => [
            'type' => 'string',
            'required' => false,
            'description' => 'query parameter `network`.',
        ],
        'address' => [
            'type' => 'string',
            'required' => true,
            'description' => 'query parameter `address`.',
        ],
        'address_tag' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Secondary address identifier for coins like XRP,XMR etc.',
        ],
        'amount' => [
            'type' => 'number',
            'required' => true,
            'description' => 'query parameter `amount`.',
        ],
        'transaction_fee_flag' => [
            'type' => 'boolean',
            'required' => false,
            'description' => 'When making internal transfer - `true` -> returning the fee to the destination account; - `false` -> returning the fee back to the departure account.',
        ],
        'name' => [
            'type' => 'string',
            'required' => false,
            'description' => 'query parameter `name`.',
        ],
        'wallet_type' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'The wallet type for withdraw，0-Spot wallet, 1- Funding wallet. Default is Spot wallet',
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
    protected const PATH = '/sapi/v1/capital/withdraw/apply';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'coin' => 'coin',
        'withdrawOrderId' => 'withdraw_order_id',
        'network' => 'network',
        'address' => 'address',
        'addressTag' => 'address_tag',
        'amount' => 'amount',
        'transactionFeeFlag' => 'transaction_fee_flag',
        'name' => 'name',
        'walletType' => 'wallet_type',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
