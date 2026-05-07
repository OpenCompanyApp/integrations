<?php

namespace OpenCompany\Integrations\Shippo\Tools;

/**
 * Create a new webhook.
 *
 * Maps to the official Shippo endpoint POST /webhooks.
 */
class ShippoCreateWebhook extends AbstractShippoTool
{
    protected const NAME = "shippo_create_webhook";
    protected const DESCRIPTION = "Create a new webhook\n\nOfficial Shippo endpoint: POST /webhooks.";
    protected const PARAMETERS = [
        "body" => [
            "type" => "object",
            "required" => true,
            "description" => "JSON request body matching the official Shippo schema for Create a new webhook.",
        ],
    ];
    protected const METHOD = "POST";
    protected const PATH = "/webhooks";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
}
