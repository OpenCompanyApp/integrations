<?php

namespace OpenCompany\Integrations\Greenhouse\Tools;

/**
 * Delete Webhook - **Greenhouse Partners Exclusive**.
 *
 * Maps to the official Greenhouse Harvest v3 endpoint DELETE /v3/webhooks/{id}.
 */
class GreenhouseDeleteV3WebhooksId extends AbstractGreenhouseTool
{
    protected const NAME = 'greenhouse_delete_v3_webhooks_id';
    protected const DESCRIPTION = 'Delete Webhook - **Greenhouse Partners Exclusive**

Official Greenhouse Harvest v3 endpoint: DELETE /v3/webhooks/{id}.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'path parameter `id`.',
        ],
    ];
    protected const METHOD = 'DELETE';
    protected const PATH = '/v3/webhooks/{id}';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const AUTH_MODE = 'bearer';
}
