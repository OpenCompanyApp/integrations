<?php

namespace OpenCompany\Integrations\ShipEngine\Tools;

/**
 * Update Account Image By ID.
 *
 * Maps to the official ShipEngine endpoint PUT /v1/account/settings/images/{label_image_id}.
 */
class ShipEngineUpdateAccountSettingsImagesById extends AbstractShipEngineTool
{
    protected const NAME = "shipengine_update_account_settings_images_by_id";
    protected const DESCRIPTION = "Update Account Image By ID\n\nOfficial ShipEngine endpoint: PUT /v1/account/settings/images/{label_image_id}.";
    protected const PARAMETERS = [
        "label_image_id" => [
            "type" => "string",
            "required" => true,
            "description" => "Label Image Id",
        ],
        "body" => [
            "type" => "object",
            "required" => true,
            "description" => "JSON request body matching the official ShipEngine schema for Update Account Image By ID.",
        ],
    ];
    protected const METHOD = "PUT";
    protected const PATH = "/v1/account/settings/images/{label_image_id}";
    protected const PATH_PARAMS = [
        "label_image_id" => "label_image_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = true;
}
