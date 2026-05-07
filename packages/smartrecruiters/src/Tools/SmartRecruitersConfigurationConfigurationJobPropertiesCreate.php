<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Create a job property.
 *
 * Maps to configuration-api.json endpoint POST /configuration/job-properties.
 */
class SmartRecruitersConfigurationConfigurationJobPropertiesCreate extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_configuration_configuration_job_properties_create";
    protected const DESCRIPTION = "Create a job property\n\nOfficial SmartRecruiters endpoint: POST /configuration/job-properties from configuration-api.json.";
    protected const PARAMETERS = [
        "body" => [
            "type" => "object",
            "required" => false,
            "description" => "job property to be created",
        ],
    ];
    protected const METHOD = "POST";
    protected const BASE_URL = "https://api.smartrecruiters.com";
    protected const PATH = "/configuration/job-properties";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
