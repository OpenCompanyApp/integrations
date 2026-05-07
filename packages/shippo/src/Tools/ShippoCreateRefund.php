<?php

namespace OpenCompany\Integrations\Shippo\Tools;

/**
 * Create a refund.
 *
 * Maps to the official Shippo endpoint POST /refunds.
 */
class ShippoCreateRefund extends AbstractShippoTool
{
    protected const NAME = "shippo_create_refund";
    protected const DESCRIPTION = "Create a refund\n\nOfficial Shippo endpoint: POST /refunds.";
    protected const PARAMETERS = [
        "shippo_api_version" => [
            "type" => "string",
            "required" => false,
            "description" => "Optional string used to pick a non-default API version to use. See our API version guide.",
        ],
        "body" => [
            "type" => "object",
            "required" => true,
            "description" => "Refund details",
        ],
    ];
    protected const METHOD = "POST";
    protected const PATH = "/refunds";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [
        "SHIPPO-API-VERSION" => "shippo_api_version",
    ];
    protected const BODY_REQUIRED = true;
}
