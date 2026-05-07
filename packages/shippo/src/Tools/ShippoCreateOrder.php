<?php

namespace OpenCompany\Integrations\Shippo\Tools;

/**
 * Create a new order.
 *
 * Maps to the official Shippo endpoint POST /orders.
 */
class ShippoCreateOrder extends AbstractShippoTool
{
    protected const NAME = "shippo_create_order";
    protected const DESCRIPTION = "Create a new order\n\nOfficial Shippo endpoint: POST /orders.";
    protected const PARAMETERS = [
        "shippo_api_version" => [
            "type" => "string",
            "required" => false,
            "description" => "Optional string used to pick a non-default API version to use. See our API version guide.",
        ],
        "body" => [
            "type" => "object",
            "required" => true,
            "description" => "Order details.",
        ],
    ];
    protected const METHOD = "POST";
    protected const PATH = "/orders";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [
        "SHIPPO-API-VERSION" => "shippo_api_version",
    ];
    protected const BODY_REQUIRED = true;
}
