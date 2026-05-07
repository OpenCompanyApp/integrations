<?php

namespace OpenCompany\Integrations\Shippo\Tools;

/**
 * Retrieve a carrier parcel templates.
 *
 * Maps to the official Shippo endpoint GET /parcel-templates/{CarrierParcelTemplateToken}.
 */
class ShippoGetCarrierParcelTemplate extends AbstractShippoTool
{
    protected const NAME = "shippo_get_carrier_parcel_template";
    protected const DESCRIPTION = "Retrieve a carrier parcel templates\n\nOfficial Shippo endpoint: GET /parcel-templates/{CarrierParcelTemplateToken}.";
    protected const PARAMETERS = [
        "carrier_parcel_template_token" => [
            "type" => "string",
            "required" => true,
            "description" => "The unique string representation of the carrier parcel template",
        ],
        "shippo_api_version" => [
            "type" => "string",
            "required" => false,
            "description" => "Optional string used to pick a non-default API version to use. See our API version guide.",
        ],
    ];
    protected const METHOD = "GET";
    protected const PATH = "/parcel-templates/{CarrierParcelTemplateToken}";
    protected const PATH_PARAMS = [
        "CarrierParcelTemplateToken" => "carrier_parcel_template_token",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [
        "SHIPPO-API-VERSION" => "shippo_api_version",
    ];
    protected const BODY_REQUIRED = false;
}
