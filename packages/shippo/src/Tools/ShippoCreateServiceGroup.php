<?php

namespace OpenCompany\Integrations\Shippo\Tools;

/**
 * Create a new service group.
 *
 * Maps to the official Shippo endpoint POST /service-groups.
 */
class ShippoCreateServiceGroup extends AbstractShippoTool
{
    protected const NAME = "shippo_create_service_group";
    protected const DESCRIPTION = "Create a new service group\n\nOfficial Shippo endpoint: POST /service-groups.";
    protected const PARAMETERS = [
        "shippo_api_version" => [
            "type" => "string",
            "required" => false,
            "description" => "Optional string used to pick a non-default API version to use. See our API version guide.",
        ],
        "body" => [
            "type" => "object",
            "required" => true,
            "description" => "JSON request body matching the official Shippo schema for Create a new service group.",
        ],
    ];
    protected const METHOD = "POST";
    protected const PATH = "/service-groups";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [
        "SHIPPO-API-VERSION" => "shippo_api_version",
    ];
    protected const BODY_REQUIRED = true;
}
