<?php

namespace OpenCompany\Integrations\Dwolla\Tools;

/**
 * List webhook subscriptions.
 *
 * Maps to the official Dwolla endpoint GET /webhook-subscriptions.
 */
class DwollaListWebhookSubscriptions extends AbstractDwollaTool
{
    protected const NAME = 'dwolla_list_webhook_subscriptions';
    protected const DESCRIPTION = 'Retrieve all webhook subscriptions that belong to an application including their configuration details and status. Returns subscription details including webhook endpoints, status, creation dates, and links to associated webhooks with total count. Essential for webhook management and monitoring subscription health.

Official Dwolla endpoint: GET /webhook-subscriptions.';
    protected const PARAMETERS = [
        'accept' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
            'enum' => ['application/vnd.dwolla.v1.hal+json'],
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/webhook-subscriptions';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [
        'Accept' => 'accept',
    ];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}
