<?php

namespace OpenCompany\Integrations\Shippo\Tools;

/**
 * Create a new parcel.
 *
 * Maps to the official Shippo endpoint POST /parcels.
 */
class ShippoCreateParcel extends AbstractShippoTool
{
    protected const NAME = "shippo_create_parcel";
    protected const DESCRIPTION = "Create a new parcel\n\nOfficial Shippo endpoint: POST /parcels.";
    protected const PARAMETERS = [
        "shippo_api_version" => [
            "type" => "string",
            "required" => false,
            "description" => "Optional string used to pick a non-default API version to use. See our API version guide.",
        ],
        "body" => [
            "type" => "object",
            "required" => true,
            "description" => "Parcel details.",
        ],
    ];
    protected const METHOD = "POST";
    protected const PATH = "/parcels";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [
        "SHIPPO-API-VERSION" => "shippo_api_version",
    ];
    protected const BODY_REQUIRED = true;
}
