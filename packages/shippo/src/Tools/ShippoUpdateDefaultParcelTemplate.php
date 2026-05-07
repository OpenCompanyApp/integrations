<?php

namespace OpenCompany\Integrations\Shippo\Tools;

/**
 * Update default parcel template.
 *
 * Maps to the official Shippo endpoint PUT /live-rates/settings/parcel-template.
 */
class ShippoUpdateDefaultParcelTemplate extends AbstractShippoTool
{
    protected const NAME = "shippo_update_default_parcel_template";
    protected const DESCRIPTION = "Update default parcel template\n\nOfficial Shippo endpoint: PUT /live-rates/settings/parcel-template.";
    protected const PARAMETERS = [
        "shippo_api_version" => [
            "type" => "string",
            "required" => false,
            "description" => "Optional string used to pick a non-default API version to use. See our API version guide.",
        ],
        "body" => [
            "type" => "object",
            "required" => false,
            "description" => "JSON request body matching the official Shippo schema for Update default parcel template.",
        ],
    ];
    protected const METHOD = "PUT";
    protected const PATH = "/live-rates/settings/parcel-template";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [
        "SHIPPO-API-VERSION" => "shippo_api_version",
    ];
    protected const BODY_REQUIRED = false;
}
