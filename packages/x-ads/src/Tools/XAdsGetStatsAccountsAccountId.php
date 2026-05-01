<?php

namespace OpenCompany\Integrations\XAds\Tools;

/**
 * X Ads API operation: Analytics / Synchronous Analytics stats/accounts/:account_id.
 */
class XAdsGetStatsAccountsAccountId extends XAdsGeneratedTool
{
    protected const SLUG = 'x_ads_get_stats_accounts_account_id';

    protected const DESCRIPTION = 'X Ads API operation: Analytics / Synchronous Analytics stats/accounts/:account_id.';

    protected const PARAMETERS = [
        'account_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Account ID path parameter.',
        ],
        'end_time' => [
            'type' => 'string',
            'required' => true,
            'description' => 'required',
        ],
        'entity' => [
            'type' => 'string',
            'required' => true,
            'description' => 'required',
        ],
        'entity_ids' => [
            'type' => 'string',
            'required' => true,
            'description' => 'required',
        ],
        'granularity' => [
            'type' => 'string',
            'required' => true,
            'description' => 'required',
        ],
        'metric_groups' => [
            'type' => 'string',
            'required' => true,
            'description' => 'required',
        ],
        'placement' => [
            'type' => 'string',
            'required' => true,
            'description' => 'required',
        ],
        'start_time' => [
            'type' => 'string',
            'required' => true,
            'description' => 'required',
        ],
    ];

    protected const OPERATION = [
        'id' => 'get_stats_accounts_account_id',
        'method' => 'GET',
        'path' => '/{version}/stats/accounts/{account_id}',
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
                'name' => 'end_time',
                'in' => 'query',
                'required' => true,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'entity',
                'in' => 'query',
                'required' => true,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'entity_ids',
                'in' => 'query',
                'required' => true,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'granularity',
                'in' => 'query',
                'required' => true,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'metric_groups',
                'in' => 'query',
                'required' => true,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'placement',
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
            'Analytics',
            'Synchronous Analytics',
        ],
    ];
}
