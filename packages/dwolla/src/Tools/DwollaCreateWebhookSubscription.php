<?php

namespace OpenCompany\Integrations\Dwolla\Tools;

/**
 * Create a webhook subscription.
 *
 * Maps to the official Dwolla endpoint POST /webhook-subscriptions.
 */
class DwollaCreateWebhookSubscription extends AbstractDwollaTool
{
    protected const NAME = 'dwolla_create_webhook_subscription';
    protected const DESCRIPTION = 'Create a webhook subscription to deliver webhook notifications to a specified URL endpoint for your application. Requires a destination URL where Dwolla will send notifications and a secret key for webhook validation and security. Returns the location of the created subscription resource. Essential for establishing real-time event notifications and automated integrations with Dwolla\'s payment processing events.

Official Dwolla endpoint: POST /webhook-subscriptions.';
    protected const PARAMETERS = [
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
    protected const PATH = '/webhook-subscriptions';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [
        'Accept' => 'accept',
    ];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}
