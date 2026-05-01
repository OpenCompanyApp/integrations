<?php

namespace OpenCompany\Integrations\XAds\Tools;

/**
 * X Ads API operation: Campaign Management / Targeting Criteria accounts/:account_id/targeting_criteria/:targeting_criterion_id.
 */
class XAdsGetAccountsAccountIdTargetingCriteriaTargetingCriterionId extends XAdsGeneratedTool
{
    protected const SLUG = 'x_ads_get_accounts_account_id_targeting_criteria_targeting_criterion_id';

    protected const DESCRIPTION = 'X Ads API operation: Campaign Management / Targeting Criteria accounts/:account_id/targeting_criteria/:targeting_criterion_id.';

    protected const PARAMETERS = [
        'account_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Account ID path parameter.',
        ],
        'lang' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'with_deleted' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
    ];

    protected const OPERATION = [
        'id' => 'get_accounts_account_id_targeting_criteria_targeting_criterion_id',
        'method' => 'GET',
        'path' => '/{version}/accounts/{account_id}/targeting_criteria/:targeting_criterion_id',
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
                'name' => 'lang',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'with_deleted',
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
