<?php

namespace OpenCompany\Integrations\Dwolla\Tools;

/**
 * Delete a webhook subscription.
 *
 * Maps to the official Dwolla endpoint DELETE /webhook-subscriptions/{id}.
 */
class DwollaDelete extends AbstractDwollaTool
{
    protected const NAME = 'dwolla_delete';
    protected const DESCRIPTION = 'Delete a webhook subscription to permanently remove webhook notifications for your application. This action stops all future webhook deliveries and cannot be undone. Returns the deleted subscription resource for confirmation. Use this endpoint when webhook notifications are no longer needed or when cleaning up unused subscriptions.

Official Dwolla endpoint: DELETE /webhook-subscriptions/{id}.';
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
    protected const METHOD = 'DELETE';
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
