<?php

namespace OpenCompany\Integrations\Urlscan\Tools;

/**
 * Update Subscription.
 *
 * Maps to the official urlscan.io endpoint PUT /api/v1/user/subscriptions/{subscriptionId}/.
 */
class UrlscanUpdateSubscription extends AbstractUrlscanTool
{
    protected const NAME = 'urlscan_update_subscription';
    protected const DESCRIPTION = 'Update Subscription

Official urlscan.io endpoint: PUT /api/v1/user/subscriptions/{subscriptionId}/.';
    protected const PARAMETERS = [
        'subscription_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'subscriptionId',
        ],
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'JSON request body matching the official urlscan.io OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'PUT';
    protected const PATH = '/api/v1/user/subscriptions/{subscriptionId}/';
    protected const PATH_PARAMS = [
        'subscriptionId' => 'subscription_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const BODY_REQUIRED = false;
}
