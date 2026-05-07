<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Get Candidate Property value by id.
 *
 * Maps to configuration-api.json endpoint GET /configuration/candidate-properties/{id}/values/{valueId}.
 */
class SmartRecruitersConfigurationConfigurationCandidatePropertiesValuesGet extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_configuration_configuration_candidate_properties_values_get";
    protected const DESCRIPTION = "Get Candidate Property value by id\n\nOfficial SmartRecruiters endpoint: GET /configuration/candidate-properties/{id}/values/{valueId} from configuration-api.json.";
    protected const PARAMETERS = [
        "id" => [
            "type" => "string",
            "required" => true,
            "description" => "Candidate property id (uuid or key)",
        ],
        "value_id" => [
            "type" => "string",
            "required" => true,
            "description" => "candidate property's value identifier",
        ],
    ];
    protected const METHOD = "GET";
    protected const BASE_URL = "https://api.smartrecruiters.com";
    protected const PATH = "/configuration/candidate-properties/{id}/values/{valueId}";
    protected const PATH_PARAMS = [
        "id" => "id",
        "valueId" => "value_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
