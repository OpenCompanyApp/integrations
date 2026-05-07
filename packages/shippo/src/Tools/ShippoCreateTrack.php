<?php

namespace OpenCompany\Integrations\Shippo\Tools;

/**
 * Register a tracking webhook.
 *
 * Maps to the official Shippo endpoint POST /tracks.
 */
class ShippoCreateTrack extends AbstractShippoTool
{
    protected const NAME = "shippo_create_track";
    protected const DESCRIPTION = "Register a tracking webhook\n\nOfficial Shippo endpoint: POST /tracks.";
    protected const PARAMETERS = [
        "shippo_api_version" => [
            "type" => "string",
            "required" => false,
            "description" => "Optional string used to pick a non-default API version to use. See our API version guide.",
        ],
        "body" => [
            "type" => "object",
            "required" => true,
            "description" => "JSON request body matching the official Shippo schema for Register a tracking webhook.",
        ],
    ];
    protected const METHOD = "POST";
    protected const PATH = "/tracks";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [
        "SHIPPO-API-VERSION" => "shippo_api_version",
    ];
    protected const BODY_REQUIRED = true;
}
