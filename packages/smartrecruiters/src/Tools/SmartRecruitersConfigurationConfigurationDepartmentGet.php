<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Get department.
 *
 * Maps to configuration-api.json endpoint GET /configuration/departments/{id}.
 */
class SmartRecruitersConfigurationConfigurationDepartmentGet extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_configuration_configuration_department_get";
    protected const DESCRIPTION = "Get department\n\nOfficial SmartRecruiters endpoint: GET /configuration/departments/{id} from configuration-api.json.";
    protected const PARAMETERS = [
        "id" => [
            "type" => "string",
            "required" => true,
            "description" => "Identifier of a department",
        ],
    ];
    protected const METHOD = "GET";
    protected const BASE_URL = "https://api.smartrecruiters.com";
    protected const PATH = "/configuration/departments/{id}";
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
