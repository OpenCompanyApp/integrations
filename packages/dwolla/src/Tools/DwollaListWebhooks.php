<?php

namespace OpenCompany\Integrations\Dwolla\Tools;

/**
 * List webhooks for a webhook subscription.
 *
 * Maps to the official Dwolla endpoint GET /webhook-subscriptions/{id}/webhooks.
 */
class DwollaListWebhooks extends AbstractDwollaTool
{
    protected const NAME = 'dwolla_list_webhooks';
    protected const DESCRIPTION = 'List webhooks for a webhook subscription

Official Dwolla endpoint: GET /webhook-subscriptions/{id}/webhooks.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Webhook subscription unique identifier',
        ],
        'limit' => [
            'type' => 'string',
            'required' => false,
            'description' => 'How many results to return',
        ],
        'offset' => [
            'type' => 'string',
            'required' => false,
            'description' => 'How many results to skip',
        ],
        'start_date' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Only include webhooks created after this date. ISO-8601 format `YYYY-MM-DD`',
        ],
        'end_date' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Only include webhooks created before this date. ISO-8601 format `YYYY-MM-DD`',
        ],
        'accept' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The media type of the response. Must be application/vnd.dwolla.v1.hal+json',
            'enum' => ['application/vnd.dwolla.v1.hal+json'],
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/webhook-subscriptions/{id}/webhooks';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [
        'limit' => 'limit',
        'offset' => 'offset',
        'startDate' => 'start_date',
        'endDate' => 'end_date',
    ];
    protected const HEADER_PARAMS = [
        'Accept' => 'accept',
    ];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const AUTH_MODE = 'bearer';
}
