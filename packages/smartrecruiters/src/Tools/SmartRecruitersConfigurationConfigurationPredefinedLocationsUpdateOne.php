<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Update predefined location.
 *
 * Maps to configuration-api.json endpoint PUT /configuration/predefined-locations/{id}.
 */
class SmartRecruitersConfigurationConfigurationPredefinedLocationsUpdateOne extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_configuration_configuration_predefined_locations_update_one";
    protected const DESCRIPTION = "Update predefined location\n\nOfficial SmartRecruiters endpoint: PUT /configuration/predefined-locations/{id} from configuration-api.json.";
    protected const PARAMETERS = [
        "id" => [
            "type" => "string",
            "required" => true,
            "description" => "path parameter `id`.",
        ],
        "body" => [
            "type" => "object",
            "required" => true,
            "description" => "Request body matching the official SmartRecruiters configuration-api.json schema for Update predefined location.",
        ],
    ];
    protected const METHOD = "PUT";
    protected const BASE_URL = "https://api.smartrecruiters.com";
    protected const PATH = "/configuration/predefined-locations/{id}";
    protected const PATH_PARAMS = [
        "id" => "id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
