<?php

namespace OpenCompany\Integrations\Shippo\Tools;

/**
 * Retrieve an existing parcel.
 *
 * Maps to the official Shippo endpoint GET /parcels/{ParcelId}.
 */
class ShippoGetParcel extends AbstractShippoTool
{
    protected const NAME = "shippo_get_parcel";
    protected const DESCRIPTION = "Retrieve an existing parcel\n\nOfficial Shippo endpoint: GET /parcels/{ParcelId}.";
    protected const PARAMETERS = [
        "parcel_id" => [
            "type" => "string",
            "required" => true,
            "description" => "Object ID of the parcel",
        ],
        "shippo_api_version" => [
            "type" => "string",
            "required" => false,
            "description" => "Optional string used to pick a non-default API version to use. See our API version guide.",
        ],
    ];
    protected const METHOD = "GET";
    protected const PATH = "/parcels/{ParcelId}";
    protected const PATH_PARAMS = [
        "ParcelId" => "parcel_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [
        "SHIPPO-API-VERSION" => "shippo_api_version",
    ];
    protected const BODY_REQUIRED = false;
}
