<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Remove job property's dependent values relationship.
 *
 * Maps to configuration-api.json endpoint DELETE /configuration/job-properties/{id}/values/{valueId}/dependents/{dependentId}/values/{dependentValueId}.
 */
class SmartRecruitersConfigurationConfigurationJobPropertiesDependentsValuesRemove extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_configuration_configuration_job_properties_dependents_values_remove";
    protected const DESCRIPTION = "Remove job property's dependent values relationship\n\nOfficial SmartRecruiters endpoint: DELETE /configuration/job-properties/{id}/values/{valueId}/dependents/{dependentId}/values/{dependentValueId} from configuration-api.json.";
    protected const PARAMETERS = [
        "id" => [
            "type" => "string",
            "required" => true,
            "description" => "job property identifier",
        ],
        "value_id" => [
            "type" => "string",
            "required" => true,
            "description" => "job property's value identifier",
        ],
        "dependent_id" => [
            "type" => "string",
            "required" => true,
            "description" => "job property's dependent identifier",
        ],
        "dependent_value_id" => [
            "type" => "string",
            "required" => true,
            "description" => "job property's dependent value identifier",
        ],
    ];
    protected const METHOD = "DELETE";
    protected const BASE_URL = "https://api.smartrecruiters.com";
    protected const PATH = "/configuration/job-properties/{id}/values/{valueId}/dependents/{dependentId}/values/{dependentValueId}";
    protected const PATH_PARAMS = [
        "id" => "id",
        "valueId" => "value_id",
        "dependentId" => "dependent_id",
        "dependentValueId" => "dependent_value_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
