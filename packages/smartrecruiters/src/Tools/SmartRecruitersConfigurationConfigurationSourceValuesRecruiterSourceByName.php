<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Get recruiter source by name.
 *
 * Maps to configuration-api.json endpoint PUT /configuration/sources/recruiters/resolve.
 */
class SmartRecruitersConfigurationConfigurationSourceValuesRecruiterSourceByName extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_configuration_configuration_source_values_recruiter_source_by_name";
    protected const DESCRIPTION = "Get recruiter source by name\n\nOfficial SmartRecruiters endpoint: PUT /configuration/sources/recruiters/resolve from configuration-api.json.";
    protected const PARAMETERS = [
        "source_name" => [
            "type" => "string",
            "required" => true,
            "description" => "Name of the source",
        ],
    ];
    protected const METHOD = "PUT";
    protected const BASE_URL = "https://api.smartrecruiters.com";
    protected const PATH = "/configuration/sources/recruiters/resolve";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        "sourceName" => "source_name",
    ];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
