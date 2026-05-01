<?php

namespace OpenCompany\Integrations\XAds\Tools;

/**
 * X Ads API operation: Analytics / Active Entities stats/accounts/:account_id/active_entities.
 */
class XAdsGetStatsAccountsAccountIdActiveEntities extends XAdsGeneratedTool
{
    protected const SLUG = 'x_ads_get_stats_accounts_account_id_active_entities';

    protected const DESCRIPTION = 'X Ads API operation: Analytics / Active Entities stats/accounts/:account_id/active_entities.';

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
        'start_time' => [
            'type' => 'string',
            'required' => true,
            'description' => 'required',
        ],
        'campaign_ids' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'funding_instrument_ids' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
        'line_item_ids' => [
            'type' => 'string',
            'required' => false,
            'description' => 'optional',
        ],
    ];

    protected const OPERATION = [
        'id' => 'get_stats_accounts_account_id_active_entities',
        'method' => 'GET',
        'path' => '/{version}/stats/accounts/{account_id}/active_entities',
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
                'name' => 'start_time',
                'in' => 'query',
                'required' => true,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'campaign_ids',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'funding_instrument_ids',
                'in' => 'query',
                'required' => false,
                'style' => null,
                'explode' => null,
            ],
            [
                'name' => 'line_item_ids',
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
            'Analytics',
            'Active Entities',
        ],
    ];
}
