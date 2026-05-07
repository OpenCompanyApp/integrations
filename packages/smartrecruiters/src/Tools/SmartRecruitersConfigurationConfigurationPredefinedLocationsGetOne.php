<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Get predefined location by id.
 *
 * Maps to configuration-api.json endpoint GET /configuration/predefined-locations/{id}.
 */
class SmartRecruitersConfigurationConfigurationPredefinedLocationsGetOne extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_configuration_configuration_predefined_locations_get_one";
    protected const DESCRIPTION = "Get predefined location by id\n\nOfficial SmartRecruiters endpoint: GET /configuration/predefined-locations/{id} from configuration-api.json.";
    protected const PARAMETERS = [
        "id" => [
            "type" => "string",
            "required" => true,
            "description" => "path parameter `id`.",
        ],
    ];
    protected const METHOD = "GET";
    protected const BASE_URL = "https://api.smartrecruiters.com";
    protected const PATH = "/configuration/predefined-locations/{id}";
    protected const PATH_PARAMS = [
        "id" => "id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
