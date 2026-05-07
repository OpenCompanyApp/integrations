<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * Cancel a subscription.
 *
 * Maps to the official GoCardless endpoint POST /subscriptions/{subscription_id}/actions/cancel.
 */
class GoCardlessCancelSubscription extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_cancel_subscription';
    protected const DESCRIPTION = 'Immediately cancels a subscription; no more payments will be created under it. Any metadata supplied to this endpoint will be stored on the payment cancellation event it causes. This will fail with a cancellation_failed error if the subscription is already cancelled or finished.

Official GoCardless endpoint: POST /subscriptions/{subscription_id}/actions/cancel.';
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
    protected const PATH = '/subscriptions/{subscription_id}/actions/cancel';
    protected const PATH_PARAMS = [
        'subscription_id' => 'subscription_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
