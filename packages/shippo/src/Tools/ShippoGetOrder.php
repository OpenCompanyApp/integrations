<?php

namespace OpenCompany\Integrations\Shippo\Tools;

/**
 * Retrieve an order.
 *
 * Maps to the official Shippo endpoint GET /orders/{OrderId}.
 */
class ShippoGetOrder extends AbstractShippoTool
{
    protected const NAME = "shippo_get_order";
    protected const DESCRIPTION = "Retrieve an order\n\nOfficial Shippo endpoint: GET /orders/{OrderId}.";
    protected const PARAMETERS = [
        "order_id" => [
            "type" => "string",
            "required" => true,
            "description" => "Object ID of the order",
        ],
        "shippo_api_version" => [
            "type" => "string",
            "required" => false,
            "description" => "Optional string used to pick a non-default API version to use. See our API version guide.",
        ],
    ];
    protected const METHOD = "GET";
    protected const PATH = "/orders/{OrderId}";
    protected const PATH_PARAMS = [
        "OrderId" => "order_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [
        "SHIPPO-API-VERSION" => "shippo_api_version",
    ];
    protected const BODY_REQUIRED = false;
}
