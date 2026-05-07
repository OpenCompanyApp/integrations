<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Create job property dependents.
 *
 * Maps to configuration-api.json endpoint POST /configuration/job-properties/{id}/dependents.
 */
class SmartRecruitersConfigurationConfigurationJobPropertiesDependentsCreate extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_configuration_configuration_job_properties_dependents_create";
    protected const DESCRIPTION = "Create job property dependents\n\nOfficial SmartRecruiters endpoint: POST /configuration/job-properties/{id}/dependents from configuration-api.json.";
    protected const PARAMETERS = [
        "id" => [
            "type" => "string",
            "required" => true,
            "description" => "job property identifier",
        ],
        "body" => [
            "type" => "object",
            "required" => true,
            "description" => "Job properties' id",
        ],
    ];
    protected const METHOD = "POST";
    protected const BASE_URL = "https://api.smartrecruiters.com";
    protected const PATH = "/configuration/job-properties/{id}/dependents";
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
