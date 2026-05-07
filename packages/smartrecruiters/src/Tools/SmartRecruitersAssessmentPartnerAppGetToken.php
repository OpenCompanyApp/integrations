<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Exchange credentials for an access token.
 *
 * Maps to assessment-partner-app.json endpoint POST /oauth/token.
 */
class SmartRecruitersAssessmentPartnerAppGetToken extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_assessment_partner_app_get_token";
    protected const DESCRIPTION = "Exchange credentials for an access token\n\nOfficial SmartRecruiters endpoint: POST /oauth/token from assessment-partner-app.json.";
    protected const PARAMETERS = [
        "body" => [
            "type" => "object",
            "required" => false,
            "description" => "Request body matching the official SmartRecruiters assessment-partner-app.json schema for Exchange credentials for an access token.",
        ],
    ];
    protected const METHOD = "POST";
    protected const BASE_URL = "https://your.domain.com";
    protected const PATH = "/oauth/token";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "form";
    protected const AUTH_MODE = "either";
}
