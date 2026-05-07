<?php

namespace OpenCompany\Integrations\Dwolla\Tools;

/**
 * Update a webhook subscription.
 *
 * Maps to the official Dwolla endpoint POST /webhook-subscriptions/{id}.
 */
class DwollaUpdateWebhookSubscription extends AbstractDwollaTool
{
    protected const NAME = 'dwolla_update_webhook_subscription';
    protected const DESCRIPTION = 'Update a webhook subscription to pause or resume webhook delivery notifications. Allows toggling the paused status to temporarily stop webhook notifications without deleting the subscription. Returns the updated subscription resource with the new paused status. Use this endpoint to manage webhook delivery during maintenance or troubleshooting periods.

Official Dwolla endpoint: POST /webhook-subscriptions/{id}.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Webhook unique identifier',
        ],
        'accept' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
            'enum' => ['application/vnd.dwolla.v1.hal+json'],
        ],
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official Dwolla OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/webhook-subscriptions/{id}';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [
        'Accept' => 'accept',
    ];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}
