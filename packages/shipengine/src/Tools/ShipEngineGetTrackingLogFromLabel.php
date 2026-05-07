<?php

namespace OpenCompany\Integrations\ShipEngine\Tools;

/**
 * Get Label Tracking Information.
 *
 * Maps to the official ShipEngine endpoint GET /v1/labels/{label_id}/track.
 */
class ShipEngineGetTrackingLogFromLabel extends AbstractShipEngineTool
{
    protected const NAME = "shipengine_get_tracking_log_from_label";
    protected const DESCRIPTION = "Get Label Tracking Information\n\nOfficial ShipEngine endpoint: GET /v1/labels/{label_id}/track.";
    protected const PARAMETERS = [
        "label_id" => [
            "type" => "string",
            "required" => true,
            "description" => "Label ID",
        ],
    ];
    protected const METHOD = "GET";
    protected const PATH = "/v1/labels/{label_id}/track";
    protected const PATH_PARAMS = [
        "label_id" => "label_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
}
