<?php

namespace OpenCompany\Integrations\Shippo\Tools;

/**
 * Create a new user parcel template.
 *
 * Maps to the official Shippo endpoint POST /user-parcel-templates.
 */
class ShippoCreateUserParcelTemplate extends AbstractShippoTool
{
    protected const NAME = "shippo_create_user_parcel_template";
    protected const DESCRIPTION = "Create a new user parcel template\n\nOfficial Shippo endpoint: POST /user-parcel-templates.";
    protected const PARAMETERS = [
        "shippo_api_version" => [
            "type" => "string",
            "required" => false,
            "description" => "Optional string used to pick a non-default API version to use. See our API version guide.",
        ],
        "body" => [
            "type" => "object",
            "required" => true,
            "description" => "JSON request body matching the official Shippo schema for Create a new user parcel template.",
        ],
    ];
    protected const METHOD = "POST";
    protected const PATH = "/user-parcel-templates";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [
        "SHIPPO-API-VERSION" => "shippo_api_version",
    ];
    protected const BODY_REQUIRED = true;
}
