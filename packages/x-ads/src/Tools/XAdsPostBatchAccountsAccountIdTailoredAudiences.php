<?php

namespace OpenCompany\Integrations\XAds\Tools;

/**
 * X Ads API operation: Audience / Tailored Audiences batch/accounts/:account_id/tailored_audiences.
 */
class XAdsPostBatchAccountsAccountIdTailoredAudiences extends XAdsGeneratedTool
{
    protected const SLUG = 'x_ads_post_batch_accounts_account_id_tailored_audiences';

    protected const DESCRIPTION = 'X Ads API operation: Audience / Tailored Audiences batch/accounts/:account_id/tailored_audiences.';

    protected const PARAMETERS = [
        'account_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Account ID path parameter.',
        ],
        'audience_type' => [
            'type' => 'string',
            'required' => true,
            'description' => 'required',
        ],
        'child_segments' => [
            'type' => 'string',
            'required' => true,
            'description' => 'required',
        ],
        'name' => [
            'type' => 'string',
            'required' => true,
            'description' => 'required',
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
        'boolean_operator' => [
            'type' => 'string',
            'required' => false,
            'description' => 'sometimes required',
        ],
        'lookback_window' => [
            'type' => 'string',
            'required' => false,
            'description' => 'sometimes required',
        ],
        'segments' => [
            'type' => 'string',
            'required' => false,
            'description' => 'sometimes required',
        ],
        'tailored_audience_id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'sometimes required',
        ],
        'frequency' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'frequency_comparator' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'negate' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
    ];

    protected const OPERATION = [
        'id' => 'post_batch_accounts_account_id_tailored_audiences',
        'method' => 'POST',
        'path' => '/{version}/batch/accounts/{account_id}/tailored_audiences',
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
                'name' => 'audience_type',
                'in' => 'query',
                'required' => true,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'child_segments',
                'in' => 'query',
                'required' => true,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'name',
                'in' => 'query',
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
            [
                'name' => 'boolean_operator',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'lookback_window',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'segments',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'tailored_audience_id',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'frequency',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'frequency_comparator',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'negate',
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
            'Audience',
            'Tailored Audiences',
        ],
    ];
}
