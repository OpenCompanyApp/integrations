<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * Pause a subscription.
 *
 * Maps to the official GoCardless endpoint POST /subscriptions/{subscription_id}/actions/pause.
 */
class GoCardlessPauseSubscription extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_pause_subscription';
    protected const DESCRIPTION = 'Pause a subscription

Official GoCardless endpoint: POST /subscriptions/{subscription_id}/actions/pause.';
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
    protected const METHOD = 'POST';
    protected const PATH = '/subscriptions/{subscription_id}/actions/pause';
    protected const PATH_PARAMS = [
        'subscription_id' => 'subscription_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
