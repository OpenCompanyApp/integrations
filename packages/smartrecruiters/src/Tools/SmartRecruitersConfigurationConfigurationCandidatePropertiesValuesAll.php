<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Get Candidate Property values.
 *
 * Maps to configuration-api.json endpoint GET /configuration/candidate-properties/{id}/values.
 */
class SmartRecruitersConfigurationConfigurationCandidatePropertiesValuesAll extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_configuration_configuration_candidate_properties_values_all";
    protected const DESCRIPTION = "Get Candidate Property values\n\nOfficial SmartRecruiters endpoint: GET /configuration/candidate-properties/{id}/values from configuration-api.json.";
    protected const PARAMETERS = [
        "id" => [
            "type" => "string",
            "required" => true,
            "description" => "Candidate property id (uuid or key)",
        ],
    ];
    protected const METHOD = "GET";
    protected const BASE_URL = "https://api.smartrecruiters.com";
    protected const PATH = "/configuration/candidate-properties/{id}/values";
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
