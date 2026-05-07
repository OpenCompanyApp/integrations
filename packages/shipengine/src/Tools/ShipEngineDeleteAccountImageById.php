<?php

namespace OpenCompany\Integrations\ShipEngine\Tools;

/**
 * Delete Account Image By Id.
 *
 * Maps to the official ShipEngine endpoint DELETE /v1/account/settings/images/{label_image_id}.
 */
class ShipEngineDeleteAccountImageById extends AbstractShipEngineTool
{
    protected const NAME = "shipengine_delete_account_image_by_id";
    protected const DESCRIPTION = "Delete Account Image By Id\n\nOfficial ShipEngine endpoint: DELETE /v1/account/settings/images/{label_image_id}.";
    protected const PARAMETERS = [
        "label_image_id" => [
            "type" => "string",
            "required" => true,
            "description" => "Label Image Id",
        ],
    ];
    protected const METHOD = "DELETE";
    protected const PATH = "/v1/account/settings/images/{label_image_id}";
    protected const PATH_PARAMS = [
        "label_image_id" => "label_image_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
}
