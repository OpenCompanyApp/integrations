<?php

namespace OpenCompany\Integrations\Shippo\Tools;

/**
 * List all carrier accounts.
 *
 * Maps to the official Shippo endpoint GET /carrier_accounts.
 */
class ShippoListCarrierAccounts extends AbstractShippoTool
{
    protected const NAME = "shippo_list_carrier_accounts";
    protected const DESCRIPTION = "List all carrier accounts\n\nOfficial Shippo endpoint: GET /carrier_accounts.";
    protected const PARAMETERS = [
        "service_levels" => [
            "type" => "boolean",
            "required" => false,
            "description" => "Appends the property `service_levels` to each returned carrier account",
        ],
        "carrier" => [
            "type" => "string",
            "enum" => [
                "airterra",
                "apc_postal",
                "apg",
                "aramex",
                "asendia_us",
                "australia_post",
                "axlehire",
                "better_trucks",
                "borderguru",
                "boxberry",
                "bring",
                "canada_post",
                "chronopost",
                "collect_plus",
                "correios_br",
                "correos_espana",
                "colissimo",
                "deutsche_post",
                "dhl_benelux",
                "dhl_ecommerce",
                "dhl_express",
                "dhl_germany_c2c",
                "dhl_germany",
                "dpd_de",
                "dpd_uk",
                "estafeta",
                "fastway_australia",
                "fedex",
                "globegistics",
                "gls_us",
                "gophr",
                "gso",
                "hermes_germany_b2c",
                "hermes_uk",
                "hongkong_post",
                "lasership",
                "lso",
                "mondial_relay",
                "new_zealand_post",
                "nippon_express",
                "ontrac",
                "parcelforce",
                "passport",
                "pcf",
                "poste_italiane",
                "posti",
                "purolator",
                "royal_mail",
                "royal_mail_sf",
                "rr_donnelley",
                "russian_post",
                "skypostal",
                "stuart",
                "swyft",
                "uds",
                "ups",
                "usps",
                "veho",
            ],
            "required" => false,
            "description" => "Filter the response by the specified carrier",
        ],
        "account_id" => [
            "type" => "string",
            "required" => false,
            "description" => "Filter the response by the specified carrier account Id",
        ],
        "page" => [
            "type" => "integer",
            "required" => false,
            "description" => "The page number you want to select",
        ],
        "results" => [
            "type" => "integer",
            "required" => false,
            "description" => "The number of results to return per page (max 100, default 5)",
        ],
        "shippo_api_version" => [
            "type" => "string",
            "required" => false,
            "description" => "Optional string used to pick a non-default API version to use. See our API version guide.",
        ],
    ];
    protected const METHOD = "GET";
    protected const PATH = "/carrier_accounts";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        "service_levels" => "service_levels",
        "carrier" => "carrier",
        "account_id" => "account_id",
        "page" => "page",
        "results" => "results",
    ];
    protected const HEADER_PARAMS = [
        "SHIPPO-API-VERSION" => "shippo_api_version",
    ];
    protected const BODY_REQUIRED = false;
}
