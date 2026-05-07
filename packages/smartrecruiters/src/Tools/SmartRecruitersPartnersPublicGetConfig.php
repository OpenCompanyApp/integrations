<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Get config for vendor.
 *
 * Maps to partners-public-api.json endpoint GET /configs/{configId}.
 */
class SmartRecruitersPartnersPublicGetConfig extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_partners_public_get_config";
    protected const DESCRIPTION = "Get config for vendor\n\nOfficial SmartRecruiters endpoint: GET /configs/{configId} from partners-public-api.json.";
    protected const PARAMETERS = [
        "config_id" => [
            "type" => "string",
            "required" => true,
            "description" => "unique id of a config entry",
        ],
    ];
    protected const METHOD = "GET";
    protected const BASE_URL = "https://api.smartrecruiters.com/v1";
    protected const PATH = "/configs/{configId}";
    protected const PATH_PARAMS = [
        "configId" => "config_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
