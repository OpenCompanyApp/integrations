<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * One click arrival deposit apply (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint POST /sapi/v1/capital/deposit/credit-apply.
 */
class BinancePostSapiV1CapitalDepositCreditApply extends AbstractBinanceTool
{
    protected const NAME = 'binance_post_sapi_v1_capital_deposit_credit_apply';
    protected const DESCRIPTION = 'One click arrival deposit apply (USER_DATA)

Apply deposit credit for expired address (One click arrival) Weight(IP): 1

Official Binance Spot endpoint: POST /sapi/v1/capital/deposit/credit-apply.';
    protected const PARAMETERS = [
        'deposit_id' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'Deposit record Id, priority use',
        ],
        'tx_id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Deposit txId, used when depositId is not specified',
        ],
        'sub_account_id' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'query parameter `subAccountId`.',
        ],
        'sub_user_id' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'query parameter `subUserId`.',
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
    protected const PATH = '/sapi/v1/capital/deposit/credit-apply';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'depositId' => 'deposit_id',
        'txId' => 'tx_id',
        'subAccountId' => 'sub_account_id',
        'subUserId' => 'sub_user_id',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
