<?php

namespace OpenCompany\Integrations\Shippo\Tools;

/**
 * Delete a specific webhook.
 *
 * Maps to the official Shippo endpoint DELETE /webhooks/{webhookId}.
 */
class ShippoDeleteWebhook extends AbstractShippoTool
{
    protected const NAME = "shippo_delete_webhook";
    protected const DESCRIPTION = "Delete a specific webhook\n\nOfficial Shippo endpoint: DELETE /webhooks/{webhookId}.";
    protected const PARAMETERS = [
        "webhook_id" => [
            "type" => "string",
            "required" => true,
            "description" => "Object ID of the webhook to delete",
        ],
    ];
    protected const METHOD = "DELETE";
    protected const PATH = "/webhooks/{webhookId}";
    protected const PATH_PARAMS = [
        "webhookId" => "webhook_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
}
