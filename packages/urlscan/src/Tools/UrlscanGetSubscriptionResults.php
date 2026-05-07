<?php

namespace OpenCompany\Integrations\Urlscan\Tools;

/**
 * Subscription Search Results.
 *
 * Maps to the official urlscan.io endpoint GET /api/v1/user/subscriptions/{subscriptionId}/results/{datasource}/.
 */
class UrlscanGetSubscriptionResults extends AbstractUrlscanTool
{
    protected const NAME = 'urlscan_get_subscription_results';
    protected const DESCRIPTION = 'Subscription Search Results

Official urlscan.io endpoint: GET /api/v1/user/subscriptions/{subscriptionId}/results/{datasource}/.';
    protected const PARAMETERS = [
        'subscription_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'subscriptionId',
        ],
        'datasource' => [
            'type' => 'string',
            'required' => true,
            'description' => 'datasource',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/user/subscriptions/{subscriptionId}/results/{datasource}/';
    protected const PATH_PARAMS = [
        'subscriptionId' => 'subscription_id',
        'datasource' => 'datasource',
    ];
    protected const QUERY_PARAMS = [];
    protected const BODY_REQUIRED = false;
}
