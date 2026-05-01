<?php

namespace OpenCompany\Integrations\XAds\Tools;

/**
 * X Ads API operation: Analytics / Asynchronous Analytics stats/jobs/accounts/:account_id/:job_id.
 */
class XAdsDeleteStatsJobsAccountsAccountIdJobId extends XAdsGeneratedTool
{
    protected const SLUG = 'x_ads_delete_stats_jobs_accounts_account_id_job_id';

    protected const DESCRIPTION = 'X Ads API operation: Analytics / Asynchronous Analytics stats/jobs/accounts/:account_id/:job_id.';

    protected const PARAMETERS = [
        'account_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Account ID path parameter.',
        ],
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'Request body or form fields for this X Ads API operation.',
        ],
    ];

    protected const OPERATION = [
        'id' => 'delete_stats_jobs_accounts_account_id_job_id',
        'method' => 'DELETE',
        'path' => '/{version}/stats/jobs/accounts/{account_id}/:job_id',
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
        ],
        'has_body' => true,
        'body_mode' => 'json',
        'auth_modes' => [
            'oauth1a_user_context',
        ],
        'required_scopes' => [
            'ads_api_access',
        ],
        'runtime_mode' => 'async_job',
        'tags' => [
            'Analytics',
            'Asynchronous Analytics',
        ],
    ];
}
