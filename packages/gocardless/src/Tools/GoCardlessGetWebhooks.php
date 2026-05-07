<?php

namespace OpenCompany\Integrations\GoCardless\Tools;

/**
 * Get a single webhook.
 *
 * Maps to the official GoCardless endpoint GET /webhooks/{webhook_id}.
 */
class GoCardlessGetWebhooks extends AbstractGoCardlessTool
{
    protected const NAME = 'gocardless_get_webhooks';
    protected const DESCRIPTION = 'Retrieves the details of an existing webhook.

Official GoCardless endpoint: GET /webhooks/{webhook_id}.';
    protected const PARAMETERS = [
        'webhook_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The webhook id',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/webhooks/{webhook_id}';
    protected const PATH_PARAMS = [
        'webhook_id' => 'webhook_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
