<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Get candidate property by id.
 *
 * Maps to configuration-api.json endpoint GET /configuration/candidate-properties/{id}.
 */
class SmartRecruitersConfigurationConfigurationCandidatePropertiesGet extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_configuration_configuration_candidate_properties_get";
    protected const DESCRIPTION = "Get candidate property by id\n\nOfficial SmartRecruiters endpoint: GET /configuration/candidate-properties/{id} from configuration-api.json.";
    protected const PARAMETERS = [
        "id" => [
            "type" => "string",
            "required" => true,
            "description" => "Candidate property id (uuid or key)",
        ],
    ];
    protected const METHOD = "GET";
    protected const BASE_URL = "https://api.smartrecruiters.com";
    protected const PATH = "/configuration/candidate-properties/{id}";
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
