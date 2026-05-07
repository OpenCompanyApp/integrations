<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Create a job property value.
 *
 * Maps to configuration-api.json endpoint POST /configuration/job-properties/{id}/values.
 */
class SmartRecruitersConfigurationConfigurationJobPropertiesValuesCreate extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_configuration_configuration_job_properties_values_create";
    protected const DESCRIPTION = "Create a job property value\n\nOfficial SmartRecruiters endpoint: POST /configuration/job-properties/{id}/values from configuration-api.json.";
    protected const PARAMETERS = [
        "id" => [
            "type" => "string",
            "required" => true,
            "description" => "job property identifier",
        ],
        "body" => [
            "type" => "object",
            "required" => false,
            "description" => "job property object to be created",
        ],
    ];
    protected const METHOD = "POST";
    protected const BASE_URL = "https://api.smartrecruiters.com";
    protected const PATH = "/configuration/job-properties/{id}/values";
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
