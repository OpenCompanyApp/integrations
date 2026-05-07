<?php

namespace OpenCompany\Integrations\Shippo\Tools;

/**
 * Retrieve a manifest.
 *
 * Maps to the official Shippo endpoint GET /manifests/{ManifestId}.
 */
class ShippoGetManifest extends AbstractShippoTool
{
    protected const NAME = "shippo_get_manifest";
    protected const DESCRIPTION = "Retrieve a manifest\n\nOfficial Shippo endpoint: GET /manifests/{ManifestId}.";
    protected const PARAMETERS = [
        "manifest_id" => [
            "type" => "string",
            "required" => true,
            "description" => "Object ID of the manifest to update",
        ],
        "shippo_api_version" => [
            "type" => "string",
            "required" => false,
            "description" => "Optional string used to pick a non-default API version to use. See our API version guide.",
        ],
    ];
    protected const METHOD = "GET";
    protected const PATH = "/manifests/{ManifestId}";
    protected const PATH_PARAMS = [
        "ManifestId" => "manifest_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [
        "SHIPPO-API-VERSION" => "shippo_api_version",
    ];
    protected const BODY_REQUIRED = false;
}
