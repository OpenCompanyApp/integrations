<?php

namespace OpenCompany\Integrations\Shippo\Tools;

/**
 * Create a shipping label.
 *
 * Maps to the official Shippo endpoint POST /transactions.
 */
class ShippoCreateTransaction extends AbstractShippoTool
{
    protected const NAME = "shippo_create_transaction";
    protected const DESCRIPTION = "Create a shipping label\n\nOfficial Shippo endpoint: POST /transactions.";
    protected const PARAMETERS = [
        "shippo_api_version" => [
            "type" => "string",
            "required" => false,
            "description" => "Optional string used to pick a non-default API version to use. See our API version guide.",
        ],
        "body" => [
            "type" => "object",
            "required" => true,
            "description" => "Examples.",
        ],
    ];
    protected const METHOD = "POST";
    protected const PATH = "/transactions";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [
        "SHIPPO-API-VERSION" => "shippo_api_version",
    ];
    protected const BODY_REQUIRED = true;
}
