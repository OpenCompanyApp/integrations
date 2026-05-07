<?php

namespace OpenCompany\Integrations\Shippo\Tools;

/**
 * Retrieves a user parcel template.
 *
 * Maps to the official Shippo endpoint GET /user-parcel-templates/{UserParcelTemplateObjectId}.
 */
class ShippoGetUserParcelTemplate extends AbstractShippoTool
{
    protected const NAME = "shippo_get_user_parcel_template";
    protected const DESCRIPTION = "Retrieves a user parcel template\n\nOfficial Shippo endpoint: GET /user-parcel-templates/{UserParcelTemplateObjectId}.";
    protected const PARAMETERS = [
        "user_parcel_template_object_id" => [
            "type" => "string",
            "required" => true,
            "description" => "Object ID of the user parcel template",
        ],
        "shippo_api_version" => [
            "type" => "string",
            "required" => false,
            "description" => "Optional string used to pick a non-default API version to use. See our API version guide.",
        ],
    ];
    protected const METHOD = "GET";
    protected const PATH = "/user-parcel-templates/{UserParcelTemplateObjectId}";
    protected const PATH_PARAMS = [
        "UserParcelTemplateObjectId" => "user_parcel_template_object_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [
        "SHIPPO-API-VERSION" => "shippo_api_version",
    ];
    protected const BODY_REQUIRED = false;
}
