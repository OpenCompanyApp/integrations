<?php

namespace OpenCompany\Integrations\Urlscan\Tools;

/**
 * Delete Subscription.
 *
 * Maps to the official urlscan.io endpoint DELETE /api/v1/user/subscriptions/{subscriptionId}/.
 */
class UrlscanDeleteSubscription extends AbstractUrlscanTool
{
    protected const NAME = 'urlscan_delete_subscription';
    protected const DESCRIPTION = 'Delete Subscription

Official urlscan.io endpoint: DELETE /api/v1/user/subscriptions/{subscriptionId}/.';
    protected const PARAMETERS = [
        'subscription_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'subscriptionId',
        ],
    ];
    protected const METHOD = 'DELETE';
    protected const PATH = '/api/v1/user/subscriptions/{subscriptionId}/';
    protected const PATH_PARAMS = [
        'subscriptionId' => 'subscription_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const BODY_REQUIRED = false;
}
