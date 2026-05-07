<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Get company information.
 *
 * Maps to configuration-api.json endpoint GET /configuration/company.
 */
class SmartRecruitersConfigurationConfigurationCompanyMy extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_configuration_configuration_company_my";
    protected const DESCRIPTION = "Get company information\n\nOfficial SmartRecruiters endpoint: GET /configuration/company from configuration-api.json.";
    protected const PARAMETERS = [];
    protected const METHOD = "GET";
    protected const BASE_URL = "https://api.smartrecruiters.com";
    protected const PATH = "/configuration/company";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
