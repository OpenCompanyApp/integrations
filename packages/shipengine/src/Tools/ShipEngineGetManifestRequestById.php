<?php

namespace OpenCompany\Integrations\ShipEngine\Tools;

/**
 * Get Manifest Request By Id.
 *
 * Maps to the official ShipEngine endpoint GET /v1/manifests/requests/{manifest_request_id}.
 */
class ShipEngineGetManifestRequestById extends AbstractShipEngineTool
{
    protected const NAME = "shipengine_get_manifest_request_by_id";
    protected const DESCRIPTION = "Get Manifest Request By Id\n\nOfficial ShipEngine endpoint: GET /v1/manifests/requests/{manifest_request_id}.";
    protected const PARAMETERS = [
        "manifest_request_id" => [
            "type" => "string",
            "required" => true,
            "description" => "The Manifest Request Id",
        ],
    ];
    protected const METHOD = "GET";
    protected const PATH = "/v1/manifests/requests/{manifest_request_id}";
    protected const PATH_PARAMS = [
        "manifest_request_id" => "manifest_request_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
}
