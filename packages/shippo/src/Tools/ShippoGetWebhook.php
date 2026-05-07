<?php

namespace OpenCompany\Integrations\Shippo\Tools;

/**
 * Retrieve a specific webhook.
 *
 * Maps to the official Shippo endpoint GET /webhooks/{webhookId}.
 */
class ShippoGetWebhook extends AbstractShippoTool
{
    protected const NAME = "shippo_get_webhook";
    protected const DESCRIPTION = "Retrieve a specific webhook\n\nOfficial Shippo endpoint: GET /webhooks/{webhookId}.";
    protected const PARAMETERS = [
        "webhook_id" => [
            "type" => "string",
            "required" => true,
            "description" => "Object ID of the webhook to retrieve",
        ],
    ];
    protected const METHOD = "GET";
    protected const PATH = "/webhooks/{webhookId}";
    protected const PATH_PARAMS = [
        "webhookId" => "webhook_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
}
