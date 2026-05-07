<?php

namespace OpenCompany\Integrations\ShipEngine\Tools;

/**
 * Get Webhook By ID.
 *
 * Maps to the official ShipEngine endpoint GET /v1/environment/webhooks/{webhook_id}.
 */
class ShipEngineGetWebhookById extends AbstractShipEngineTool
{
    protected const NAME = "shipengine_get_webhook_by_id";
    protected const DESCRIPTION = "Get Webhook By ID\n\nOfficial ShipEngine endpoint: GET /v1/environment/webhooks/{webhook_id}.";
    protected const PARAMETERS = [
        "webhook_id" => [
            "type" => "string",
            "required" => true,
            "description" => "Webhook ID",
        ],
    ];
    protected const METHOD = "GET";
    protected const PATH = "/v1/environment/webhooks/{webhook_id}";
    protected const PATH_PARAMS = [
        "webhook_id" => "webhook_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
}
