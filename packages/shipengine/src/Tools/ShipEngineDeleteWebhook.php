<?php

namespace OpenCompany\Integrations\ShipEngine\Tools;

/**
 * Delete Webhook By ID.
 *
 * Maps to the official ShipEngine endpoint DELETE /v1/environment/webhooks/{webhook_id}.
 */
class ShipEngineDeleteWebhook extends AbstractShipEngineTool
{
    protected const NAME = "shipengine_delete_webhook";
    protected const DESCRIPTION = "Delete Webhook By ID\n\nOfficial ShipEngine endpoint: DELETE /v1/environment/webhooks/{webhook_id}.";
    protected const PARAMETERS = [
        "webhook_id" => [
            "type" => "string",
            "required" => true,
            "description" => "Webhook ID",
        ],
    ];
    protected const METHOD = "DELETE";
    protected const PATH = "/v1/environment/webhooks/{webhook_id}";
    protected const PATH_PARAMS = [
        "webhook_id" => "webhook_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
}
