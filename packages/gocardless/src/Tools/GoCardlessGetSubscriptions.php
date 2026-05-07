<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * Get a single subscription.
 *
 * Maps to the official GoCardless endpoint GET /subscriptions/{subscription_id}.
 */
class GoCardlessGetSubscriptions extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_get_subscriptions';
    protected const DESCRIPTION = 'Retrieves the details of a single subscription.

Official GoCardless endpoint: GET /subscriptions/{subscription_id}.';
    protected const PARAMETERS = [
        'subscription_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The subscription id',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/subscriptions/{subscription_id}';
    protected const PATH_PARAMS = [
        'subscription_id' => 'subscription_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
