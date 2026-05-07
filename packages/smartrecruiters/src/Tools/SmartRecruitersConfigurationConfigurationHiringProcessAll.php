<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Get list of hiring process.
 *
 * Maps to configuration-api.json endpoint GET /configuration/hiring-processes.
 */
class SmartRecruitersConfigurationConfigurationHiringProcessAll extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_configuration_configuration_hiring_process_all";
    protected const DESCRIPTION = "Get list of hiring process\n\nOfficial SmartRecruiters endpoint: GET /configuration/hiring-processes from configuration-api.json.";
    protected const PARAMETERS = [];
    protected const METHOD = "GET";
    protected const BASE_URL = "https://api.smartrecruiters.com";
    protected const PATH = "/configuration/hiring-processes";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
