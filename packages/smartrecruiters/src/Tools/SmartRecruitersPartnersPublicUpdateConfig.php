<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Update config.
 *
 * Maps to partners-public-api.json endpoint POST /configs/{configId}.
 */
class SmartRecruitersPartnersPublicUpdateConfig extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_partners_public_update_config";
    protected const DESCRIPTION = "Update config\n\nOfficial SmartRecruiters endpoint: POST /configs/{configId} from partners-public-api.json.";
    protected const PARAMETERS = [
        "config_id" => [
            "type" => "string",
            "required" => true,
            "description" => "unique id of a config entry",
        ],
        "body" => [
            "type" => "object",
            "required" => true,
            "description" => "Config object that needs to contain Id and Value set. Please see the Model Schema on the right.",
        ],
    ];
    protected const METHOD = "POST";
    protected const BASE_URL = "https://api.smartrecruiters.com/v1";
    protected const PATH = "/configs/{configId}";
    protected const PATH_PARAMS = [
        "configId" => "config_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
