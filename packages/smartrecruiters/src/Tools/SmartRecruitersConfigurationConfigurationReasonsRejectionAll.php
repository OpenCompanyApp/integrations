<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Get rejection reasons.
 *
 * Maps to configuration-api.json endpoint GET /configuration/rejection-reasons.
 */
class SmartRecruitersConfigurationConfigurationReasonsRejectionAll extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_configuration_configuration_reasons_rejection_all";
    protected const DESCRIPTION = "Get rejection reasons\n\nOfficial SmartRecruiters endpoint: GET /configuration/rejection-reasons from configuration-api.json.";
    protected const PARAMETERS = [];
    protected const METHOD = "GET";
    protected const BASE_URL = "https://api.smartrecruiters.com";
    protected const PATH = "/configuration/rejection-reasons";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
