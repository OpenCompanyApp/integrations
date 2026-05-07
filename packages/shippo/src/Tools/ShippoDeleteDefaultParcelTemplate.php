<?php

namespace OpenCompany\Integrations\Shippo\Tools;

/**
 * Clear current default parcel template.
 *
 * Maps to the official Shippo endpoint DELETE /live-rates/settings/parcel-template.
 */
class ShippoDeleteDefaultParcelTemplate extends AbstractShippoTool
{
    protected const NAME = "shippo_delete_default_parcel_template";
    protected const DESCRIPTION = "Clear current default parcel template\n\nOfficial Shippo endpoint: DELETE /live-rates/settings/parcel-template.";
    protected const PARAMETERS = [
        "shippo_api_version" => [
            "type" => "string",
            "required" => false,
            "description" => "Optional string used to pick a non-default API version to use. See our API version guide.",
        ],
    ];
    protected const METHOD = "DELETE";
    protected const PATH = "/live-rates/settings/parcel-template";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [
        "SHIPPO-API-VERSION" => "shippo_api_version",
    ];
    protected const BODY_REQUIRED = false;
}
