<?php

namespace OpenCompany\Integrations\ShipEngine\Tools;

/**
 * Disconnect a carrier.
 *
 * Maps to the official ShipEngine endpoint DELETE /v1/connections/carriers/{carrier_name}/{carrier_id}.
 */
class ShipEngineDisconnectCarrier extends AbstractShipEngineTool
{
    protected const NAME = "shipengine_disconnect_carrier";
    protected const DESCRIPTION = "Disconnect a carrier\n\nOfficial ShipEngine endpoint: DELETE /v1/connections/carriers/{carrier_name}/{carrier_id}.";
    protected const PARAMETERS = [
        "carrier_name" => [
            "type" => "string",
            "enum" => [
                "access_worldwide",
                "amazon_buy_shipping",
                "amazon_shipping_uk",
                "apc",
                "asendia",
                "australia_post",
                "canada_post",
                "dhl_ecommerce",
                "dhl_express",
                "dhl_express_au",
                "dhl_express_ca",
                "dhl_express_uk",
                "dpd",
                "endicia",
                "fedex",
                "fedex_uk",
                "firstmile",
                "imex",
                "newgistics",
                "ontrac",
                "purolator_canada",
                "royal_mail",
                "rr_donnelley",
                "seko",
                "sendle",
                "stamps_com",
                "ups",
                "lasership",
            ],
            "required" => true,
            "description" => "The carrier name, such as stamps_com, ups, fedex, or dhl_express.",
        ],
        "carrier_id" => [
            "type" => "string",
            "required" => true,
            "description" => "Carrier ID",
        ],
    ];
    protected const METHOD = "DELETE";
    protected const PATH = "/v1/connections/carriers/{carrier_name}/{carrier_id}";
    protected const PATH_PARAMS = [
        "carrier_name" => "carrier_name",
        "carrier_id" => "carrier_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
}
