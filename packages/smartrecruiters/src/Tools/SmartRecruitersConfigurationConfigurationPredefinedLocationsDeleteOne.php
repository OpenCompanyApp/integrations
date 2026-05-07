<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Remove predefined location.
 *
 * Maps to configuration-api.json endpoint DELETE /configuration/predefined-locations/{id}.
 */
class SmartRecruitersConfigurationConfigurationPredefinedLocationsDeleteOne extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_configuration_configuration_predefined_locations_delete_one";
    protected const DESCRIPTION = "Remove predefined location\n\nOfficial SmartRecruiters endpoint: DELETE /configuration/predefined-locations/{id} from configuration-api.json.";
    protected const PARAMETERS = [
        "id" => [
            "type" => "string",
            "required" => true,
            "description" => "path parameter `id`.",
        ],
    ];
    protected const METHOD = "DELETE";
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
