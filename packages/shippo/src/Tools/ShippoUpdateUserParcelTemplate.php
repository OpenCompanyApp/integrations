<?php

namespace OpenCompany\Integrations\Shippo\Tools;

/**
 * Update an existing user parcel template.
 *
 * Maps to the official Shippo endpoint PUT /user-parcel-templates/{UserParcelTemplateObjectId}.
 */
class ShippoUpdateUserParcelTemplate extends AbstractShippoTool
{
    protected const NAME = "shippo_update_user_parcel_template";
    protected const DESCRIPTION = "Update an existing user parcel template\n\nOfficial Shippo endpoint: PUT /user-parcel-templates/{UserParcelTemplateObjectId}.";
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
        "body" => [
            "type" => "object",
            "required" => false,
            "description" => "JSON request body matching the official Shippo schema for Update an existing user parcel template.",
        ],
    ];
    protected const METHOD = "PUT";
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
