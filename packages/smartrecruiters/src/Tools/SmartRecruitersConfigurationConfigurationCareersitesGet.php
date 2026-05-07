<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Get details of career site configuration.
 *
 * Maps to configuration-api.json endpoint GET /configuration/career-sites/{careerSiteId}.
 */
class SmartRecruitersConfigurationConfigurationCareersitesGet extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_configuration_configuration_careersites_get";
    protected const DESCRIPTION = "Get details of career site configuration\n\nOfficial SmartRecruiters endpoint: GET /configuration/career-sites/{careerSiteId} from configuration-api.json.";
    protected const PARAMETERS = [
        "career_site_id" => [
            "type" => "string",
            "required" => true,
            "description" => "Id of a career site configuration",
        ],
    ];
    protected const METHOD = "GET";
    protected const BASE_URL = "https://api.smartrecruiters.com";
    protected const PATH = "/configuration/career-sites/{careerSiteId}";
    protected const PATH_PARAMS = [
        "careerSiteId" => "career_site_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
