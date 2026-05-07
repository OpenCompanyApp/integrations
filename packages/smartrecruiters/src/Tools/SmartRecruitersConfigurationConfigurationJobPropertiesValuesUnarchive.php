<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Unarchive a job property value.
 *
 * Maps to configuration-api.json endpoint DELETE /configuration/job-properties/{id}/archive-values/{valueId}.
 */
class SmartRecruitersConfigurationConfigurationJobPropertiesValuesUnarchive extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_configuration_configuration_job_properties_values_unarchive";
    protected const DESCRIPTION = "Unarchive a job property value\n\nOfficial SmartRecruiters endpoint: DELETE /configuration/job-properties/{id}/archive-values/{valueId} from configuration-api.json.";
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
    ];
    protected const METHOD = "DELETE";
    protected const BASE_URL = "https://api.smartrecruiters.com";
    protected const PATH = "/configuration/job-properties/{id}/archive-values/{valueId}";
    protected const PATH_PARAMS = [
        "id" => "id",
        "valueId" => "value_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
