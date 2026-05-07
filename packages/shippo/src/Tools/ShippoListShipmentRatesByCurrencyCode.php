<?php

namespace OpenCompany\Integrations\Shippo\Tools;

/**
 * Retrieve shipment rates in currency.
 *
 * Maps to the official Shippo endpoint GET /shipments/{ShipmentId}/rates/{CurrencyCode}.
 */
class ShippoListShipmentRatesByCurrencyCode extends AbstractShippoTool
{
    protected const NAME = "shippo_list_shipment_rates_by_currency_code";
    protected const DESCRIPTION = "Retrieve shipment rates in currency\n\nOfficial Shippo endpoint: GET /shipments/{ShipmentId}/rates/{CurrencyCode}.";
    protected const PARAMETERS = [
        "shipment_id" => [
            "type" => "string",
            "required" => true,
            "description" => "Object ID of the shipment to update",
        ],
        "currency_code" => [
            "type" => "string",
            "required" => true,
            "description" => "ISO currency code for the rates",
        ],
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
    ];
    protected const METHOD = "GET";
    protected const PATH = "/shipments/{ShipmentId}/rates/{CurrencyCode}";
    protected const PATH_PARAMS = [
        "ShipmentId" => "shipment_id",
        "CurrencyCode" => "currency_code",
    ];
    protected const QUERY_PARAMS = [
        "page" => "page",
        "results" => "results",
    ];
    protected const HEADER_PARAMS = [
        "SHIPPO-API-VERSION" => "shippo_api_version",
    ];
    protected const BODY_REQUIRED = false;
}
