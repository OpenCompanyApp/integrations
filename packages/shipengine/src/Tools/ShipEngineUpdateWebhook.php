<?php

namespace OpenCompany\Integrations\ShipEngine\Tools;

/**
 * Update a Webhook.
 *
 * Maps to the official ShipEngine endpoint PUT /v1/environment/webhooks/{webhook_id}.
 */
class ShipEngineUpdateWebhook extends AbstractShipEngineTool
{
    protected const NAME = "shipengine_update_webhook";
    protected const DESCRIPTION = "Update a Webhook\n\nOfficial ShipEngine endpoint: PUT /v1/environment/webhooks/{webhook_id}.";
    protected const PARAMETERS = [
        "webhook_id" => [
            "type" => "string",
            "required" => true,
            "description" => "Webhook ID",
        ],
        "body" => [
            "type" => "object",
            "required" => true,
            "description" => "JSON request body matching the official ShipEngine schema for Update a Webhook.",
        ],
    ];
    protected const METHOD = "PUT";
    protected const PATH = "/v1/environment/webhooks/{webhook_id}";
    protected const PATH_PARAMS = [
        "webhook_id" => "webhook_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = true;
}
