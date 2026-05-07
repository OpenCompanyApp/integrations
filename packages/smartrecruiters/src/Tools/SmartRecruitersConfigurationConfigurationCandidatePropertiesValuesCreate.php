<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Create candidate property value.
 *
 * Maps to configuration-api.json endpoint POST /configuration/candidate-properties/{id}/values.
 */
class SmartRecruitersConfigurationConfigurationCandidatePropertiesValuesCreate extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_configuration_configuration_candidate_properties_values_create";
    protected const DESCRIPTION = "Create candidate property value\n\nOfficial SmartRecruiters endpoint: POST /configuration/candidate-properties/{id}/values from configuration-api.json.";
    protected const PARAMETERS = [
        "id" => [
            "type" => "string",
            "required" => true,
            "description" => "Candidate property id (uuid or key)",
        ],
        "body" => [
            "type" => "object",
            "required" => true,
            "description" => "Candidate property value.",
        ],
    ];
    protected const METHOD = "POST";
    protected const BASE_URL = "https://api.smartrecruiters.com";
    protected const PATH = "/configuration/candidate-properties/{id}/values";
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
