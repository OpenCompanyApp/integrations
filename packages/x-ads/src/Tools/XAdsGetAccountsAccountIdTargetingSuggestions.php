<?php

namespace OpenCompany\Integrations\XAds\Tools;

/**
 * X Ads API operation: Campaign Management / Targeting Suggestions accounts/:account_id/targeting_suggestions.
 */
class XAdsGetAccountsAccountIdTargetingSuggestions extends XAdsGeneratedTool
{
    protected const SLUG = 'x_ads_get_accounts_account_id_targeting_suggestions';

    protected const DESCRIPTION = 'X Ads API operation: Campaign Management / Targeting Suggestions accounts/:account_id/targeting_suggestions.';

    protected const PARAMETERS = [
        'account_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Account ID path parameter.',
        ],
        'suggestion_type' => [
            'type' => 'string',
            'required' => true,
            'description' => 'required',
        ],
        'targeting_values' => [
            'type' => 'string',
            'required' => true,
            'description' => 'required',
        ],
        'count' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
    ];

    protected const OPERATION = [
        'id' => 'get_accounts_account_id_targeting_suggestions',
        'method' => 'GET',
        'path' => '/{version}/accounts/{account_id}/targeting_suggestions',
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
                'name' => 'suggestion_type',
                'in' => 'query',
                'required' => true,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'targeting_values',
                'in' => 'query',
                'required' => true,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'count',
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
            'Targeting Suggestions',
        ],
    ];
}
