<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * Update a subscription.
 *
 * Maps to the official GoCardless endpoint PUT /subscriptions/{subscription_id}.
 */
class GoCardlessUpdateSubscriptions extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_update_subscriptions';
    protected const DESCRIPTION = 'Update a subscription

Official GoCardless endpoint: PUT /subscriptions/{subscription_id}.';
    protected const PARAMETERS = [
        'subscription_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The subscription id',
        ],
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'Request body matching the official GoCardless OpenAPI schema.',
        ],
        'idempotency_key' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Optional GoCardless Idempotency-Key header for safely retrying write operations.',
        ],
    ];
    protected const METHOD = 'PUT';
    protected const PATH = '/subscriptions/{subscription_id}';
    protected const PATH_PARAMS = [
        'subscription_id' => 'subscription_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
