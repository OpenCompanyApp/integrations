<?php

namespace OpenCompany\Integrations\ShipEngine\Tools;

/**
 * Purchase Label from Rate Shopper.
 *
 * Maps to the official ShipEngine endpoint POST /v1/labels/rate_shopper_id/{rate_shopper_id}.
 */
class ShipEngineCreateLabelFromRateShopper extends AbstractShipEngineTool
{
    protected const NAME = "shipengine_create_label_from_rate_shopper";
    protected const DESCRIPTION = "Purchase Label from Rate Shopper\n\nOfficial ShipEngine endpoint: POST /v1/labels/rate_shopper_id/{rate_shopper_id}.";
    protected const PARAMETERS = [
        "rate_shopper_id" => [
            "type" => "string",
            "enum" => [
                "best_value",
                "cheapest",
                "fastest",
            ],
            "required" => true,
            "description" => "The rate selection strategy for the Rate Shopper. This determines which carrier and service will be automatically selected from your wallet carriers based on the rates returned for the shipment.",
        ],
        "body" => [
            "type" => "object",
            "required" => true,
            "description" => "Label creation details with inline shipment",
        ],
    ];
    protected const METHOD = "POST";
    protected const PATH = "/v1/labels/rate_shopper_id/{rate_shopper_id}";
    protected const PATH_PARAMS = [
        "rate_shopper_id" => "rate_shopper_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = true;
}
