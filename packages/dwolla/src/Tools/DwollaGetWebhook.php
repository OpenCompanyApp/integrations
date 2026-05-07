<?php

namespace OpenCompany\Integrations\Dwolla\Tools;

/**
 * Retrieve a webhook.
 *
 * Maps to the official Dwolla endpoint GET /webhooks/{id}.
 */
class DwollaGetWebhook extends AbstractDwollaTool
{
    protected const NAME = 'dwolla_get_webhook';
    protected const DESCRIPTION = 'Retrieve detailed information for a specific webhook by its unique identifier including delivery attempts and response data. Returns webhook details with topic, account information, delivery attempts containing request/response history, and links to subscription and retry resources. Essential for debugging webhook delivery issues, analyzing response data, and monitoring notification processing status.

Official Dwolla endpoint: GET /webhooks/{id}.';
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
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/webhooks/{id}';
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
