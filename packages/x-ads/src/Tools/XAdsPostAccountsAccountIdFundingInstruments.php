<?php

namespace OpenCompany\Integrations\XAds\Tools;

/**
 * X Ads API operation: Campaign Management / Funding Instruments accounts/:account_id/funding_instruments.
 */
class XAdsPostAccountsAccountIdFundingInstruments extends XAdsGeneratedTool
{
    protected const SLUG = 'x_ads_post_accounts_account_id_funding_instruments';

    protected const DESCRIPTION = 'X Ads API operation: Campaign Management / Funding Instruments accounts/:account_id/funding_instruments.';

    protected const PARAMETERS = [
        'account_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Account ID path parameter.',
        ],
        'currency' => [
            'type' => 'string',
            'required' => true,
            'description' => 'required',
        ],
        'start_time' => [
            'type' => 'string',
            'required' => true,
            'description' => 'required',
        ],
        'type' => [
            'type' => 'string',
            'required' => true,
            'description' => 'required',
        ],
        'end_time' => [
            'type' => 'string',
            'required' => true,
            'description' => 'sometimes required',
        ],
        'credit_limit_local_micro' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'funded_amount_local_micro' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
    ];

    protected const OPERATION = [
        'id' => 'post_accounts_account_id_funding_instruments',
        'method' => 'POST',
        'path' => '/{version}/accounts/{account_id}/funding_instruments',
        'parameters' => [
            [
                'name' => 'version',
                'in' => 'path',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'account_id',
                'in' => 'path',
                'required' => true,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'currency',
                'in' => 'query',
                'required' => true,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'start_time',
                'in' => 'query',
                'required' => true,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'type',
                'in' => 'query',
                'required' => true,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'end_time',
                'in' => 'query',
                'required' => true,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'credit_limit_local_micro',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'funded_amount_local_micro',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
        ],
        'has_body' => false,
        'body_mode' => 'form',
        'auth_modes' => [
            'oauth1a_user_context',
        ],
        'required_scopes' => [
            'ads_api_access',
        ],
        'runtime_mode' => 'request_response',
        'tags' => [
            'Campaign Management',
            'Funding Instruments',
        ],
    ];
}
