<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Create predefined location.
 *
 * Maps to configuration-api.json endpoint POST /configuration/predefined-locations.
 */
class SmartRecruitersConfigurationConfigurationPredefinedLocationsCreateOne extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_configuration_configuration_predefined_locations_create_one";
    protected const DESCRIPTION = "Create predefined location\n\nOfficial SmartRecruiters endpoint: POST /configuration/predefined-locations from configuration-api.json.";
    protected const PARAMETERS = [
        "body" => [
            "type" => "object",
            "required" => true,
            "description" => "Request body matching the official SmartRecruiters configuration-api.json schema for Create predefined location.",
        ],
    ];
    protected const METHOD = "POST";
    protected const BASE_URL = "https://api.smartrecruiters.com";
    protected const PATH = "/configuration/predefined-locations";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
