<?php

namespace OpenCompany\Integrations\ShipEngine\Tools;

/**
 * Create a Webhook.
 *
 * Maps to the official ShipEngine endpoint POST /v1/environment/webhooks.
 */
class ShipEngineCreateWebhook extends AbstractShipEngineTool
{
    protected const NAME = "shipengine_create_webhook";
    protected const DESCRIPTION = "Create a Webhook\n\nOfficial ShipEngine endpoint: POST /v1/environment/webhooks.";
    protected const PARAMETERS = [
        "body" => [
            "type" => "object",
            "required" => true,
            "description" => "JSON request body matching the official ShipEngine schema for Create a Webhook.",
        ],
    ];
    protected const METHOD = "POST";
    protected const PATH = "/v1/environment/webhooks";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = true;
}
