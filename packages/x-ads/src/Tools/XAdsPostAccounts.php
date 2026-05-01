<?php

namespace OpenCompany\Integrations\XAds\Tools;

/**
 * X Ads API operation: Campaign Management / Accounts accounts.
 */
class XAdsPostAccounts extends XAdsGeneratedTool
{
    protected const SLUG = 'x_ads_post_accounts';

    protected const DESCRIPTION = 'X Ads API operation: Campaign Management / Accounts accounts.';

    protected const PARAMETERS = [
    ];

    protected const OPERATION = [
        'id' => 'post_accounts',
        'method' => 'POST',
        'path' => '/{version}/accounts',
        'parameters' => [
            [
                'name' => 'version',
                'in' => 'path',
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
            'Accounts',
        ],
    ];
}
