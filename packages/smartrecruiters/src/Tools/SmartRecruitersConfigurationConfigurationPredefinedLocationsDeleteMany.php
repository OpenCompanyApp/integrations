<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Remove multiple predefined locations.
 *
 * Maps to configuration-api.json endpoint DELETE /configuration/predefined-locations.
 */
class SmartRecruitersConfigurationConfigurationPredefinedLocationsDeleteMany extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_configuration_configuration_predefined_locations_delete_many";
    protected const DESCRIPTION = "Remove multiple predefined locations\n\nOfficial SmartRecruiters endpoint: DELETE /configuration/predefined-locations from configuration-api.json.";
    protected const PARAMETERS = [
        "body" => [
            "type" => "object",
            "required" => true,
            "description" => "Request body matching the official SmartRecruiters configuration-api.json schema for Remove multiple predefined locations.",
        ],
    ];
    protected const METHOD = "DELETE";
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
