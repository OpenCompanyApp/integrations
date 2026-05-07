<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * Resume a subscription.
 *
 * Maps to the official GoCardless endpoint POST /subscriptions/{subscription_id}/actions/resume.
 */
class GoCardlessResumeSubscription extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_resume_subscription';
    protected const DESCRIPTION = 'Resume a subscription

Official GoCardless endpoint: POST /subscriptions/{subscription_id}/actions/resume.';
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
    protected const PATH = '/subscriptions/{subscription_id}/actions/resume';
    protected const PATH_PARAMS = [
        'subscription_id' => 'subscription_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
