<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Add a job property's translations.
 *
 * Maps to configuration-api.json endpoint PATCH /configuration/job-properties/{id}/translations.
 */
class SmartRecruitersConfigurationConfigurationJobPropertiesTranslationsPatch extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_configuration_configuration_job_properties_translations_patch";
    protected const DESCRIPTION = "Add a job property's translations\n\nOfficial SmartRecruiters endpoint: PATCH /configuration/job-properties/{id}/translations from configuration-api.json.";
    protected const PARAMETERS = [
        "id" => [
            "type" => "string",
            "required" => true,
            "description" => "job property identifier",
        ],
        "body" => [
            "type" => "object",
            "required" => true,
            "description" => "Request body matching the official SmartRecruiters configuration-api.json schema for Add a job property's translations.",
        ],
    ];
    protected const METHOD = "PATCH";
    protected const BASE_URL = "https://api.smartrecruiters.com";
    protected const PATH = "/configuration/job-properties/{id}/translations";
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
