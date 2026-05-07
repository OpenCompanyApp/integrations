<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Get hiring process.
 *
 * Maps to configuration-api.json endpoint GET /configuration/hiring-processes/{id}.
 */
class SmartRecruitersConfigurationConfigurationHiringProcessGet extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_configuration_configuration_hiring_process_get";
    protected const DESCRIPTION = "Get hiring process\n\nOfficial SmartRecruiters endpoint: GET /configuration/hiring-processes/{id} from configuration-api.json.";
    protected const PARAMETERS = [
        "id" => [
            "type" => "string",
            "required" => true,
            "description" => "Identifier of a hiring process",
        ],
    ];
    protected const METHOD = "GET";
    protected const BASE_URL = "https://api.smartrecruiters.com";
    protected const PATH = "/configuration/hiring-processes/{id}";
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
