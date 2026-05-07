<?php

namespace OpenCompany\Integrations\Shippo\Tools;

/**
 * Validate an address.
 *
 * Maps to the official Shippo endpoint GET /addresses/{AddressId}/validate.
 */
class ShippoValidateAddress extends AbstractShippoTool
{
    protected const NAME = "shippo_validate_address";
    protected const DESCRIPTION = "Validate an address\n\nOfficial Shippo endpoint: GET /addresses/{AddressId}/validate.";
    protected const PARAMETERS = [
        "address_id" => [
            "type" => "string",
            "required" => true,
            "description" => "Object ID of the address",
        ],
        "shippo_api_version" => [
            "type" => "string",
            "required" => false,
            "description" => "Optional string used to pick a non-default API version to use. See our API version guide.",
        ],
    ];
    protected const METHOD = "GET";
    protected const PATH = "/addresses/{AddressId}/validate";
    protected const PATH_PARAMS = [
        "AddressId" => "address_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [
        "SHIPPO-API-VERSION" => "shippo_api_version",
    ];
    protected const BODY_REQUIRED = false;
}
