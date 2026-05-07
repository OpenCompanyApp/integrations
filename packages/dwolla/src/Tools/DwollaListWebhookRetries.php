<?php

namespace OpenCompany\Integrations\Dwolla\Tools;

/**
 * List retries for a webhook.
 *
 * Maps to the official Dwolla endpoint GET /webhooks/{id}/retries.
 */
class DwollaListWebhookRetries extends AbstractDwollaTool
{
    protected const NAME = 'dwolla_list_webhook_retries';
    protected const DESCRIPTION = 'Retrieve all retry attempts for a specific webhook including timestamps and delivery details. Returns a list of retry attempts with unique identifiers, timestamps, and links to the parent webhook with total count. Essential for tracking webhook delivery failures, analyzing retry patterns, and debugging webhook notification issues to ensure reliable event processing.

Official Dwolla endpoint: GET /webhooks/{id}/retries.';
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
