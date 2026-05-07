<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * get partner configuration.
 *
 * Maps to assessment-partner-api.json endpoint GET /partner/configuration.
 */
class SmartRecruitersAssessmentPartnerGetPartnerConfig extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_assessment_partner_get_partner_config";
    protected const DESCRIPTION = "get partner configuration\n\nOfficial SmartRecruiters endpoint: GET /partner/configuration from assessment-partner-api.json.";
    protected const PARAMETERS = [];
    protected const METHOD = "GET";
    protected const BASE_URL = "https://api.smartrecruiters.com/assessment-api/v202010";
    protected const PATH = "/partner/configuration";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "bearer";
}
