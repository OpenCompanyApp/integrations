<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Creates department.
 *
 * Maps to configuration-api.json endpoint POST /configuration/departments.
 */
class SmartRecruitersConfigurationConfigurationDepartmentCreate extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_configuration_configuration_department_create";
    protected const DESCRIPTION = "Creates department\n\nOfficial SmartRecruiters endpoint: POST /configuration/departments from configuration-api.json.";
    protected const PARAMETERS = [
        "body" => [
            "type" => "object",
            "required" => true,
            "description" => "department to be created",
        ],
    ];
    protected const METHOD = "POST";
    protected const BASE_URL = "https://api.smartrecruiters.com";
    protected const PATH = "/configuration/departments";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
