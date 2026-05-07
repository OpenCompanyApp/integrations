<?php

namespace OpenCompany\Integrations\Dwolla\Tools;

/**
 * Retrieve a webhook subscription.
 *
 * Maps to the official Dwolla endpoint GET /webhook-subscriptions/{id}.
 */
class DwollaGetWebhookSubscription extends AbstractDwollaTool
{
    protected const NAME = 'dwolla_get_webhook_subscription';
    protected const DESCRIPTION = 'Retrieve detailed information for a specific webhook subscription by its unique identifier. Returns subscription configuration including URL endpoint, creation date, and links to associated webhooks for comprehensive subscription management. Essential for monitoring webhook subscription status and accessing webhook delivery history.

Official Dwolla endpoint: GET /webhook-subscriptions/{id}.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Webhook subscription unique identifier',
        ],
        'accept' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
            'enum' => ['application/vnd.dwolla.v1.hal+json'],
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/webhook-subscriptions/{id}';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [
        'Accept' => 'accept',
    ];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}
