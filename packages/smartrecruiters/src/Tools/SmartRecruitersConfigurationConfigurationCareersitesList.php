<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * List career sites configurations.
 *
 * Maps to configuration-api.json endpoint GET /configuration/career-sites.
 */
class SmartRecruitersConfigurationConfigurationCareersitesList extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_configuration_configuration_careersites_list";
    protected const DESCRIPTION = "List career sites configurations\n\nOfficial SmartRecruiters endpoint: GET /configuration/career-sites from configuration-api.json.";
    protected const PARAMETERS = [
        "page_id" => [
            "type" => "string",
            "required" => false,
            "description" => "pageId",
        ],
        "page_size" => [
            "type" => "integer",
            "required" => false,
            "description" => "pageSize",
        ],
    ];
    protected const METHOD = "GET";
    protected const BASE_URL = "https://api.smartrecruiters.com";
    protected const PATH = "/configuration/career-sites";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        "pageId" => "page_id",
        "pageSize" => "page_size",
    ];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
