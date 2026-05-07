<?php

namespace OpenCompany\Integrations\Shippo\Tools;

/**
 * List all service groups.
 *
 * Maps to the official Shippo endpoint GET /service-groups.
 */
class ShippoListServiceGroups extends AbstractShippoTool
{
    protected const NAME = "shippo_list_service_groups";
    protected const DESCRIPTION = "List all service groups\n\nOfficial Shippo endpoint: GET /service-groups.";
    protected const PARAMETERS = [
        "shippo_api_version" => [
            "type" => "string",
            "required" => false,
            "description" => "Optional string used to pick a non-default API version to use. See our API version guide.",
        ],
    ];
    protected const METHOD = "GET";
    protected const PATH = "/service-groups";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [
        "SHIPPO-API-VERSION" => "shippo_api_version",
    ];
    protected const BODY_REQUIRED = false;
}
