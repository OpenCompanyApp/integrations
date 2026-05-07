<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * Create a Billing Request with Actions.
 *
 * Maps to the official GoCardless endpoint POST /billing_requests/create_with_actions.
 */
class GoCardlessCreateWithActionsBillingRequests extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_create_with_actions_billing_requests';
    protected const DESCRIPTION = 'Creates a billing request and completes any specified actions in a single request. This endpoint allows you to create a billing request and immediately complete actions such as collecting customer details, bank account details, or other required actions.

Official GoCardless endpoint: POST /billing_requests/create_with_actions.';
    protected const PARAMETERS = [
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
    protected const PATH = '/billing_requests/create_with_actions';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
