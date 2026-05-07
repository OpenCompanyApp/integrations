<?php

namespace OpenCompany\Integrations\Shippo\Tools;

/**
 * Retrieve a customs item.
 *
 * Maps to the official Shippo endpoint GET /customs/items/{CustomsItemId}.
 */
class ShippoGetCustomsItem extends AbstractShippoTool
{
    protected const NAME = "shippo_get_customs_item";
    protected const DESCRIPTION = "Retrieve a customs item\n\nOfficial Shippo endpoint: GET /customs/items/{CustomsItemId}.";
    protected const PARAMETERS = [
        "customs_item_id" => [
            "type" => "string",
            "required" => true,
            "description" => "Object ID of the customs item",
        ],
        "page" => [
            "type" => "integer",
            "required" => false,
            "description" => "The page number you want to select",
        ],
        "shippo_api_version" => [
            "type" => "string",
            "required" => false,
            "description" => "Optional string used to pick a non-default API version to use. See our API version guide.",
        ],
    ];
    protected const METHOD = "GET";
    protected const PATH = "/customs/items/{CustomsItemId}";
    protected const PATH_PARAMS = [
        "CustomsItemId" => "customs_item_id",
    ];
    protected const QUERY_PARAMS = [
        "page" => "page",
    ];
    protected const HEADER_PARAMS = [
        "SHIPPO-API-VERSION" => "shippo_api_version",
    ];
    protected const BODY_REQUIRED = false;
}
