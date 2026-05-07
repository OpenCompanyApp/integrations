<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Update a job property.
 *
 * Maps to configuration-api.json endpoint PATCH /configuration/job-properties/{id}.
 */
class SmartRecruitersConfigurationConfigurationJobPropertiesUpdate extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_configuration_configuration_job_properties_update";
    protected const DESCRIPTION = "Update a job property\n\nOfficial SmartRecruiters endpoint: PATCH /configuration/job-properties/{id} from configuration-api.json.";
    protected const PARAMETERS = [
        "id" => [
            "type" => "string",
            "required" => true,
            "description" => "job property identifier",
        ],
        "body" => [
            "type" => "object",
            "required" => false,
            "description" => "patch request",
        ],
    ];
    protected const METHOD = "PATCH";
    protected const BASE_URL = "https://api.smartrecruiters.com";
    protected const PATH = "/configuration/job-properties/{id}";
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
