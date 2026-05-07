<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * List access groups.
 *
 * Maps to configuration-api.json endpoint GET /configuration/access-groups.
 */
class SmartRecruitersConfigurationConfigurationAccessGroupList extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_configuration_configuration_access_group_list";
    protected const DESCRIPTION = "List access groups\n\nOfficial SmartRecruiters endpoint: GET /configuration/access-groups from configuration-api.json.";
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
    protected const PATH = "/configuration/access-groups";
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
