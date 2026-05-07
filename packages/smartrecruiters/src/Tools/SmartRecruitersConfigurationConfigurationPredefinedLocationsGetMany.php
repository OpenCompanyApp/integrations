<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Get list of predefined locations.
 *
 * Maps to configuration-api.json endpoint GET /configuration/predefined-locations.
 */
class SmartRecruitersConfigurationConfigurationPredefinedLocationsGetMany extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_configuration_configuration_predefined_locations_get_many";
    protected const DESCRIPTION = "Get list of predefined locations\n\nOfficial SmartRecruiters endpoint: GET /configuration/predefined-locations from configuration-api.json.";
    protected const PARAMETERS = [
        "page_id" => [
            "type" => "string",
            "required" => false,
            "description" => "pageId",
        ],
        "page_size" => [
            "type" => "integer",
            "required" => false,
            "description" => "pageSize",
        ],
        "identifiers" => [
            "type" => "array",
            "items" => [
                "type" => "string",
            ],
            "required" => false,
            "description" => "Comma-separated list of identifiers to filter by",
        ],
    ];
    protected const METHOD = "GET";
    protected const BASE_URL = "https://api.smartrecruiters.com";
    protected const PATH = "/configuration/predefined-locations";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        "pageId" => "page_id",
        "pageSize" => "page_size",
        "identifiers" => "identifiers",
    ];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
