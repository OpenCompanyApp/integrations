<?php

namespace OpenCompany\Integrations\ShipEngine\Tools;

/**
 * Get Account Image By ID.
 *
 * Maps to the official ShipEngine endpoint GET /v1/account/settings/images/{label_image_id}.
 */
class ShipEngineGetAccountSettingsImagesById extends AbstractShipEngineTool
{
    protected const NAME = "shipengine_get_account_settings_images_by_id";
    protected const DESCRIPTION = "Get Account Image By ID\n\nOfficial ShipEngine endpoint: GET /v1/account/settings/images/{label_image_id}.";
    protected const PARAMETERS = [
        "label_image_id" => [
            "type" => "string",
            "required" => true,
            "description" => "Label Image Id",
        ],
    ];
    protected const METHOD = "GET";
    protected const PATH = "/v1/account/settings/images/{label_image_id}";
    protected const PATH_PARAMS = [
        "label_image_id" => "label_image_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
}
