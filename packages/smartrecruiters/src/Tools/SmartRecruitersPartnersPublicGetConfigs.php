<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Fetch list of vendor configs.
 *
 * Maps to partners-public-api.json endpoint GET /configs.
 */
class SmartRecruitersPartnersPublicGetConfigs extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_partners_public_get_configs";
    protected const DESCRIPTION = "Fetch list of vendor configs\n\nOfficial SmartRecruiters endpoint: GET /configs from partners-public-api.json.";
    protected const PARAMETERS = [];
    protected const METHOD = "GET";
    protected const BASE_URL = "https://api.smartrecruiters.com/v1";
    protected const PATH = "/configs";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
