<?php

namespace OpenCompany\Integrations\Shippo\Tools;

/**
 * Get Carrier Registration status.
 *
 * Maps to the official Shippo endpoint GET /carrier_accounts/reg-status.
 */
class ShippoGetCarrierRegistrationStatus extends AbstractShippoTool
{
    protected const NAME = "shippo_get_carrier_registration_status";
    protected const DESCRIPTION = "Get Carrier Registration status\n\nOfficial Shippo endpoint: GET /carrier_accounts/reg-status.";
    protected const PARAMETERS = [
        "carrier" => [
            "type" => "string",
            "enum" => [
                "ups",
                "usps",
                "canada_post",
            ],
            "required" => true,
            "description" => "filter by specific carrier",
        ],
        "shippo_api_version" => [
            "type" => "string",
            "required" => false,
            "description" => "Optional string used to pick a non-default API version to use. See our API version guide.",
        ],
    ];
    protected const METHOD = "GET";
    protected const PATH = "/carrier_accounts/reg-status";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        "carrier" => "carrier",
    ];
    protected const HEADER_PARAMS = [
        "SHIPPO-API-VERSION" => "shippo_api_version",
    ];
    protected const BODY_REQUIRED = false;
}
