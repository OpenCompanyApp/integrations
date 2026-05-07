<?php

namespace OpenCompany\Integrations\Urlscan\Tools;

/**
 * Create Subscription.
 *
 * Maps to the official urlscan.io endpoint POST /api/v1/user/subscriptions/.
 */
class UrlscanCreateSubscription extends AbstractUrlscanTool
{
    protected const NAME = 'urlscan_create_subscription';
    protected const DESCRIPTION = 'Create Subscription

Official urlscan.io endpoint: POST /api/v1/user/subscriptions/.';
    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'JSON request body matching the official urlscan.io OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/user/subscriptions/';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const BODY_REQUIRED = false;
}
