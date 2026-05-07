<?php

namespace OpenCompany\Integrations\Shippo\Tools;

/**
 * Add a Shippo carrier account.
 *
 * Maps to the official Shippo endpoint POST /carrier_accounts/register/new.
 */
class ShippoRegisterCarrierAccount extends AbstractShippoTool
{
    protected const NAME = "shippo_register_carrier_account";
    protected const DESCRIPTION = "Add a Shippo carrier account\n\nOfficial Shippo endpoint: POST /carrier_accounts/register/new.";
    protected const PARAMETERS = [
        "shippo_api_version" => [
            "type" => "string",
            "required" => false,
            "description" => "Optional string used to pick a non-default API version to use. See our API version guide.",
        ],
        "body" => [
            "type" => "object",
            "required" => true,
            "description" => "The body of the request.",
        ],
    ];
    protected const METHOD = "POST";
    protected const PATH = "/carrier_accounts/register/new";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [
        "SHIPPO-API-VERSION" => "shippo_api_version",
    ];
    protected const BODY_REQUIRED = true;
}
