<?php

namespace OpenCompany\Integrations\Shippo\Tools;

/**
 * Delete a service group.
 *
 * Maps to the official Shippo endpoint DELETE /service-groups/{ServiceGroupId}.
 */
class ShippoDeleteServiceGroup extends AbstractShippoTool
{
    protected const NAME = "shippo_delete_service_group";
    protected const DESCRIPTION = "Delete a service group\n\nOfficial Shippo endpoint: DELETE /service-groups/{ServiceGroupId}.";
    protected const PARAMETERS = [
        "service_group_id" => [
            "type" => "string",
            "required" => true,
            "description" => "Object ID of the service group",
        ],
        "shippo_api_version" => [
            "type" => "string",
            "required" => false,
            "description" => "Optional string used to pick a non-default API version to use. See our API version guide.",
        ],
    ];
    protected const METHOD = "DELETE";
    protected const PATH = "/service-groups/{ServiceGroupId}";
    protected const PATH_PARAMS = [
        "ServiceGroupId" => "service_group_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [
        "SHIPPO-API-VERSION" => "shippo_api_version",
    ];
    protected const BODY_REQUIRED = false;
}
