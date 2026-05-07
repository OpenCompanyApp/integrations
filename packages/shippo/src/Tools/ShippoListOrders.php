<?php

namespace OpenCompany\Integrations\Shippo\Tools;

/**
 * List all orders.
 *
 * Maps to the official Shippo endpoint GET /orders.
 */
class ShippoListOrders extends AbstractShippoTool
{
    protected const NAME = "shippo_list_orders";
    protected const DESCRIPTION = "List all orders\n\nOfficial Shippo endpoint: GET /orders.";
    protected const PARAMETERS = [
        "page" => [
            "type" => "integer",
            "required" => false,
            "description" => "The page number you want to select",
        ],
        "results" => [
            "type" => "integer",
            "required" => false,
            "description" => "The number of results to return per page (max 100)",
        ],
        "shippo_api_version" => [
            "type" => "string",
            "required" => false,
            "description" => "Optional string used to pick a non-default API version to use. See our API version guide.",
        ],
        "order_status" => [
            "type" => "array",
            "items" => [
                "type" => "string",
            ],
            "required" => false,
            "description" => "Filter orders by order status",
        ],
        "shop_app" => [
            "type" => "string",
            "enum" => [
                "Amazon",
                "Bigcommerce",
                "CSV_Import",
                "eBay",
                "ePages",
                "Etsy",
                "Godaddy",
                "Magento",
                "Shippo",
                "Shopify",
                "Spreecommerce",
                "StripeRelay",
                "Walmart",
                "Weebly",
                "WooCommerce",
            ],
            "required" => false,
            "description" => "Filter orders by shop app",
        ],
        "start_date" => [
            "type" => "string",
            "required" => false,
            "description" => "Filter orders created after the input date and time (ISO 8601 UTC format). This is based on the `placed_at` field, meaning when the order has been placed, not when the order object was created.",
        ],
        "end_date" => [
            "type" => "string",
            "required" => false,
            "description" => "Filter orders created before the input date and time (ISO 8601 UTC format). This is based on the `placed_at` field, meaning when the order has been placed, not when the order object was created.",
        ],
    ];
    protected const METHOD = "GET";
    protected const PATH = "/orders";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        "page" => "page",
        "results" => "results",
        "order_status[]" => "order_status",
        "shop_app" => "shop_app",
        "start_date" => "start_date",
        "end_date" => "end_date",
    ];
    protected const HEADER_PARAMS = [
        "SHIPPO-API-VERSION" => "shippo_api_version",
    ];
    protected const BODY_REQUIRED = false;
}
