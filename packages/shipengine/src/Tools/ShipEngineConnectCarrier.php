<?php

namespace OpenCompany\Integrations\ShipEngine\Tools;

/**
 * Connect a carrier account.
 *
 * Maps to the official ShipEngine endpoint POST /v1/connections/carriers/{carrier_name}.
 */
class ShipEngineConnectCarrier extends AbstractShipEngineTool
{
    protected const NAME = "shipengine_connect_carrier";
    protected const DESCRIPTION = "Connect a carrier account\n\nOfficial ShipEngine endpoint: POST /v1/connections/carriers/{carrier_name}.";
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
        "body" => [
            "type" => "object",
            "required" => true,
            "description" => "JSON request body matching the official ShipEngine schema for Connect a carrier account.",
        ],
    ];
    protected const METHOD = "POST";
    protected const PATH = "/v1/connections/carriers/{carrier_name}";
    protected const PATH_PARAMS = [
        "carrier_name" => "carrier_name",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = true;
}
