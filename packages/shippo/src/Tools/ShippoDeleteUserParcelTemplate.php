<?php

namespace OpenCompany\Integrations\Shippo\Tools;

/**
 * Delete a user parcel template.
 *
 * Maps to the official Shippo endpoint DELETE /user-parcel-templates/{UserParcelTemplateObjectId}.
 */
class ShippoDeleteUserParcelTemplate extends AbstractShippoTool
{
    protected const NAME = "shippo_delete_user_parcel_template";
    protected const DESCRIPTION = "Delete a user parcel template\n\nOfficial Shippo endpoint: DELETE /user-parcel-templates/{UserParcelTemplateObjectId}.";
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
    protected const METHOD = "DELETE";
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
