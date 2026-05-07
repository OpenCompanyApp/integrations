<?php

namespace OpenCompany\Integrations\Binance\Tools;

/**
 * Redeem a Binance Code (USER_DATA).
 *
 * Maps to the official Binance Spot endpoint POST /sapi/v1/giftcard/redeemCode.
 */
class BinancePostSapiV1GiftcardRedeemcode extends AbstractBinanceTool
{
    protected const NAME = 'binance_post_sapi_v1_giftcard_redeemcode';
    protected const DESCRIPTION = 'Redeem a Binance Code (USER_DATA)

This API is for redeeming the Binance Code. Once redeemed, the coins will be deposited in your funding wallet. Please note that if you enter the wrong code 5 times within 24 hours, you will no longer be able to redeem any Binance Code that day. Weight(IP): 1

Official Binance Spot endpoint: POST /sapi/v1/giftcard/redeemCode.';
    protected const PARAMETERS = [
        'code' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Binance Code',
        ],
        'external_uid' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Each external unique ID represents a unique user on the partner platform. The function helps you to identify the redemption behavior of different users, such as redemption frequency and amount. It also helps risk and limit control of a single account, such as daily limit on redemption volume, frequency, and incorrect number of entries. This will also prevent a single user account reach the partner\'s daily redemption limits. We strongly recommend you to use this feature and transfer us the User ID of your users if you have different users redeeming Binance codes on your platform. To protect user data privacy, you may choose to transfer the user id in any desired format (max. 400 characters).',
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
    protected const PATH = '/sapi/v1/giftcard/redeemCode';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'code' => 'code',
        'externalUid' => 'external_uid',
        'recvWindow' => 'recv_window',
        'timestamp' => 'timestamp',
    ];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'signed';
}
