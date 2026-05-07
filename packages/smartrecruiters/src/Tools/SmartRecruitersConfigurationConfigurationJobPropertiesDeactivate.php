<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Deactivate a job property.
 *
 * Maps to configuration-api.json endpoint DELETE /configuration/job-properties/{id}/activation.
 */
class SmartRecruitersConfigurationConfigurationJobPropertiesDeactivate extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_configuration_configuration_job_properties_deactivate";
    protected const DESCRIPTION = "Deactivate a job property\n\nOfficial SmartRecruiters endpoint: DELETE /configuration/job-properties/{id}/activation from configuration-api.json.";
    protected const PARAMETERS = [
        "id" => [
            "type" => "string",
            "required" => true,
            "description" => "job property identifier",
        ],
    ];
    protected const METHOD = "DELETE";
    protected const BASE_URL = "https://api.smartrecruiters.com";
    protected const PATH = "/configuration/job-properties/{id}/activation";
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
