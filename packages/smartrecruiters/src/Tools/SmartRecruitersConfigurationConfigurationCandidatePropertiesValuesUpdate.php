<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Update candidate property value label.
 *
 * Maps to configuration-api.json endpoint PUT /configuration/candidate-properties/{id}/values/{valueId}.
 */
class SmartRecruitersConfigurationConfigurationCandidatePropertiesValuesUpdate extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_configuration_configuration_candidate_properties_values_update";
    protected const DESCRIPTION = "Update candidate property value label\n\nOfficial SmartRecruiters endpoint: PUT /configuration/candidate-properties/{id}/values/{valueId} from configuration-api.json.";
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
        "body" => [
            "type" => "object",
            "required" => true,
            "description" => "Candidate property value label.",
        ],
    ];
    protected const METHOD = "PUT";
    protected const BASE_URL = "https://api.smartrecruiters.com";
    protected const PATH = "/configuration/candidate-properties/{id}/values/{valueId}";
    protected const PATH_PARAMS = [
        "id" => "id",
        "valueId" => "value_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
