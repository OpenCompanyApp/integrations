<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Add job property's dependent value.
 *
 * Maps to configuration-api.json endpoint POST /configuration/job-properties/{id}/values/{valueId}/dependents/{dependentId}/values.
 */
class SmartRecruitersConfigurationConfigurationJobPropertiesDependentsValuesAdd extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_configuration_configuration_job_properties_dependents_values_add";
    protected const DESCRIPTION = "Add job property's dependent value\n\nOfficial SmartRecruiters endpoint: POST /configuration/job-properties/{id}/values/{valueId}/dependents/{dependentId}/values from configuration-api.json.";
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
        "body" => [
            "type" => "object",
            "required" => true,
            "description" => "Identifier of job property's dependent value",
        ],
    ];
    protected const METHOD = "POST";
    protected const BASE_URL = "https://api.smartrecruiters.com";
    protected const PATH = "/configuration/job-properties/{id}/values/{valueId}/dependents/{dependentId}/values";
    protected const PATH_PARAMS = [
        "id" => "id",
        "valueId" => "value_id",
        "dependentId" => "dependent_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
