<?php

namespace OpenCompany\Integrations\Dwolla\Tools;

/**
 * Retry a webhook.
 *
 * Maps to the official Dwolla endpoint POST /webhooks/{id}/retries.
 */
class DwollaRetryWebhook extends AbstractDwollaTool
{
    protected const NAME = 'dwolla_retry_webhook';
    protected const DESCRIPTION = 'Retry a webhook by its unique identifier to redeliver the notification to your endpoint. Creates a new retry attempt and returns the location of the new webhook resource. Essential for recovering from webhook delivery failures and ensuring reliable event notification processing in your application.

Official Dwolla endpoint: POST /webhooks/{id}/retries.';
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
            'required' => false,
            'description' => 'Request body matching the official Dwolla OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/webhooks/{id}/retries';
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
