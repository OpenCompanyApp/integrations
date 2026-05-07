<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Add new config.
 *
 * Maps to partners-public-api.json endpoint POST /configs.
 */
class SmartRecruitersPartnersPublicAddConfig extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_partners_public_add_config";
    protected const DESCRIPTION = "Add new config\n\nOfficial SmartRecruiters endpoint: POST /configs from partners-public-api.json.";
    protected const PARAMETERS = [
        "body" => [
            "type" => "object",
            "required" => true,
            "description" => "Config object that needs to contain Id and Value set. Please see the Model Schema on the right.",
        ],
    ];
    protected const METHOD = "POST";
    protected const BASE_URL = "https://api.smartrecruiters.com/v1";
    protected const PATH = "/configs";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
