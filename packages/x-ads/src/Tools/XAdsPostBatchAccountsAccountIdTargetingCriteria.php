<?php

namespace OpenCompany\Integrations\XAds\Tools;

/**
 * X Ads API operation: Campaign Management / Targeting Criteria batch/accounts/:account_id/targeting_criteria.
 */
class XAdsPostBatchAccountsAccountIdTargetingCriteria extends XAdsGeneratedTool
{
    protected const SLUG = 'x_ads_post_batch_accounts_account_id_targeting_criteria';

    protected const DESCRIPTION = 'X Ads API operation: Campaign Management / Targeting Criteria batch/accounts/:account_id/targeting_criteria.';

    protected const PARAMETERS = [
        'account_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Account ID path parameter.',
        ],
        'operation_type' => [
            'type' => 'string',
            'required' => true,
            'description' => 'required',
        ],
        'params' => [
            'type' => 'string',
            'required' => true,
            'description' => 'required',
        ],
    ];

    protected const OPERATION = [
        'id' => 'post_batch_accounts_account_id_targeting_criteria',
        'method' => 'POST',
        'path' => '/{version}/batch/accounts/{account_id}/targeting_criteria',
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
                'name' => 'operation_type',
                'in' => 'query',
                'required' => true,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'params',
                'in' => 'query',
                'required' => true,
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
