<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Shows consent form on partner side.
 *
 * Maps to assessment-partner-app.json endpoint GET /integration.
 */
class SmartRecruitersAssessmentPartnerAppAskForConsent extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_assessment_partner_app_ask_for_consent";
    protected const DESCRIPTION = "Shows consent form on partner side\n\nOfficial SmartRecruiters endpoint: GET /integration from assessment-partner-app.json.";
    protected const PARAMETERS = [
        "company_id" => [
            "type" => "string",
            "required" => false,
            "description" => "id of company setting up the integration",
        ],
    ];
    protected const METHOD = "GET";
    protected const BASE_URL = "https://your.domain.com";
    protected const PATH = "/integration";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        "companyId" => "company_id",
    ];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
