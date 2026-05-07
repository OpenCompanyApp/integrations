<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Remove job property's dependent.
 *
 * Maps to configuration-api.json endpoint DELETE /configuration/job-properties/{id}/dependents/{dependentId}.
 */
class SmartRecruitersConfigurationConfigurationJobPropertiesDependentsRemove extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_configuration_configuration_job_properties_dependents_remove";
    protected const DESCRIPTION = "Remove job property's dependent\n\nOfficial SmartRecruiters endpoint: DELETE /configuration/job-properties/{id}/dependents/{dependentId} from configuration-api.json.";
    protected const PARAMETERS = [
        "id" => [
            "type" => "string",
            "required" => true,
            "description" => "job property identifier",
        ],
        "dependent_id" => [
            "type" => "string",
            "required" => true,
            "description" => "job property's dependent identifier",
        ],
    ];
    protected const METHOD = "DELETE";
    protected const BASE_URL = "https://api.smartrecruiters.com";
    protected const PATH = "/configuration/job-properties/{id}/dependents/{dependentId}";
    protected const PATH_PARAMS = [
        "id" => "id",
        "dependentId" => "dependent_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
