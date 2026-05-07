<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * enable the company integration.
 *
 * Maps to assessment-partner-api.json endpoint POST /integration/company/{companyId}.
 */
class SmartRecruitersAssessmentPartnerSetUpIntegration extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_assessment_partner_set_up_integration";
    protected const DESCRIPTION = "enable the company integration\n\nOfficial SmartRecruiters endpoint: POST /integration/company/{companyId} from assessment-partner-api.json.";
    protected const PARAMETERS = [
        "company_id" => [
            "type" => "string",
            "required" => true,
            "description" => "path parameter `companyId`.",
        ],
        "body" => [
            "type" => "object",
            "required" => false,
            "description" => "Request body matching the official SmartRecruiters assessment-partner-api.json schema for enable the company integration.",
        ],
    ];
    protected const METHOD = "POST";
    protected const BASE_URL = "https://api.smartrecruiters.com/assessment-api/v202010";
    protected const PATH = "/integration/company/{companyId}";
    protected const PATH_PARAMS = [
        "companyId" => "company_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "bearer";
}
