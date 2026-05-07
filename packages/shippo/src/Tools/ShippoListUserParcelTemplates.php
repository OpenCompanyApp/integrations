<?php

namespace OpenCompany\Integrations\Shippo\Tools;

/**
 * List all user parcel templates.
 *
 * Maps to the official Shippo endpoint GET /user-parcel-templates.
 */
class ShippoListUserParcelTemplates extends AbstractShippoTool
{
    protected const NAME = "shippo_list_user_parcel_templates";
    protected const DESCRIPTION = "List all user parcel templates\n\nOfficial Shippo endpoint: GET /user-parcel-templates.";
    protected const PARAMETERS = [
        "shippo_api_version" => [
            "type" => "string",
            "required" => false,
            "description" => "Optional string used to pick a non-default API version to use. See our API version guide.",
        ],
    ];
    protected const METHOD = "GET";
    protected const PATH = "/user-parcel-templates";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [
        "SHIPPO-API-VERSION" => "shippo_api_version",
    ];
    protected const BODY_REQUIRED = false;
}
