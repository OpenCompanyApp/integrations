<?php

namespace OpenCompany\Integrations\XAds\Tools;

/**
 * X Ads API operation: Campaign Management / Targeting Criteria accounts/:account_id/targeting_criteria.
 */
class XAdsPostAccountsAccountIdTargetingCriteria extends XAdsGeneratedTool
{
    protected const SLUG = 'x_ads_post_accounts_account_id_targeting_criteria';

    protected const DESCRIPTION = 'X Ads API operation: Campaign Management / Targeting Criteria accounts/:account_id/targeting_criteria.';

    protected const PARAMETERS = [
        'account_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Account ID path parameter.',
        ],
        'line_item_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'required',
        ],
        'targeting_type' => [
            'type' => 'string',
            'required' => true,
            'description' => 'required',
        ],
        'targeting_value' => [
            'type' => 'string',
            'required' => true,
            'description' => 'required',
        ],
        'tailored_audience_expansion' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'operator_type' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
    ];

    protected const OPERATION = [
        'id' => 'post_accounts_account_id_targeting_criteria',
        'method' => 'POST',
        'path' => '/{version}/accounts/{account_id}/targeting_criteria',
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
                'name' => 'line_item_id',
                'in' => 'query',
                'required' => true,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'targeting_type',
                'in' => 'query',
                'required' => true,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'targeting_value',
                'in' => 'query',
                'required' => true,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'tailored_audience_expansion',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'operator_type',
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
            'Targeting Criteria',
        ],
    ];
}
