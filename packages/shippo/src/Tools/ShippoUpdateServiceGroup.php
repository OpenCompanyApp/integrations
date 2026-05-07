<?php

namespace OpenCompany\Integrations\Shippo\Tools;

/**
 * Update an existing service group.
 *
 * Maps to the official Shippo endpoint PUT /service-groups.
 */
class ShippoUpdateServiceGroup extends AbstractShippoTool
{
    protected const NAME = "shippo_update_service_group";
    protected const DESCRIPTION = "Update an existing service group\n\nOfficial Shippo endpoint: PUT /service-groups.";
    protected const PARAMETERS = [
        "shippo_api_version" => [
            "type" => "string",
            "required" => false,
            "description" => "Optional string used to pick a non-default API version to use. See our API version guide.",
        ],
        "body" => [
            "type" => "object",
            "required" => false,
            "description" => "JSON request body matching the official Shippo schema for Update an existing service group.",
        ],
    ];
    protected const METHOD = "PUT";
    protected const PATH = "/service-groups";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [
        "SHIPPO-API-VERSION" => "shippo_api_version",
    ];
    protected const BODY_REQUIRED = false;
}
