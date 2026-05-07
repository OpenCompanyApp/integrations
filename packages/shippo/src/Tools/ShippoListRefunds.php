<?php

namespace OpenCompany\Integrations\Shippo\Tools;

/**
 * List all refunds.
 *
 * Maps to the official Shippo endpoint GET /refunds/.
 */
class ShippoListRefunds extends AbstractShippoTool
{
    protected const NAME = "shippo_list_refunds";
    protected const DESCRIPTION = "List all refunds\n\nOfficial Shippo endpoint: GET /refunds/.";
    protected const PARAMETERS = [
        "shippo_api_version" => [
            "type" => "string",
            "required" => false,
            "description" => "Optional string used to pick a non-default API version to use. See our API version guide.",
        ],
    ];
    protected const METHOD = "GET";
    protected const PATH = "/refunds/";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [
        "SHIPPO-API-VERSION" => "shippo_api_version",
    ];
    protected const BODY_REQUIRED = false;
}
