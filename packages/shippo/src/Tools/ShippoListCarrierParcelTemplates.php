<?php

namespace OpenCompany\Integrations\Shippo\Tools;

/**
 * List all carrier parcel templates.
 *
 * Maps to the official Shippo endpoint GET /parcel-templates.
 */
class ShippoListCarrierParcelTemplates extends AbstractShippoTool
{
    protected const NAME = "shippo_list_carrier_parcel_templates";
    protected const DESCRIPTION = "List all carrier parcel templates\n\nOfficial Shippo endpoint: GET /parcel-templates.";
    protected const PARAMETERS = [
        "include" => [
            "type" => "string",
            "enum" => [
                "all",
                "user",
                "enabled",
            ],
            "required" => false,
            "description" => "filter by user or enabled",
        ],
        "carrier" => [
            "type" => "string",
            "required" => false,
            "description" => "filter by specific carrier",
        ],
        "shippo_api_version" => [
            "type" => "string",
            "required" => false,
            "description" => "Optional string used to pick a non-default API version to use. See our API version guide.",
        ],
    ];
    protected const METHOD = "GET";
    protected const PATH = "/parcel-templates";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        "include" => "include",
        "carrier" => "carrier",
    ];
    protected const HEADER_PARAMS = [
        "SHIPPO-API-VERSION" => "shippo_api_version",
    ];
    protected const BODY_REQUIRED = false;
}
