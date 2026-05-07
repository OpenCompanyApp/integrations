<?php

namespace OpenCompany\Integrations\Shippo\Tools;

/**
 * Update an existing webhook.
 *
 * Maps to the official Shippo endpoint PUT /webhooks/{webhookId}.
 */
class ShippoUpdateWebhook extends AbstractShippoTool
{
    protected const NAME = "shippo_update_webhook";
    protected const DESCRIPTION = "Update an existing webhook\n\nOfficial Shippo endpoint: PUT /webhooks/{webhookId}.";
    protected const PARAMETERS = [
        "webhook_id" => [
            "type" => "string",
            "required" => true,
            "description" => "Object ID of the webhook to retrieve",
        ],
        "body" => [
            "type" => "object",
            "required" => true,
            "description" => "JSON request body matching the official Shippo schema for Update an existing webhook.",
        ],
    ];
    protected const METHOD = "PUT";
    protected const PATH = "/webhooks/{webhookId}";
    protected const PATH_PARAMS = [
        "webhookId" => "webhook_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
}
