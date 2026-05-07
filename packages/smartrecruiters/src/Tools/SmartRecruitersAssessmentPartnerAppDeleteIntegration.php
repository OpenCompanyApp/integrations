<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Removes integration on partner side.
 *
 * Maps to assessment-partner-app.json endpoint DELETE /integrations/companies/{companyId}.
 */
class SmartRecruitersAssessmentPartnerAppDeleteIntegration extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_assessment_partner_app_delete_integration";
    protected const DESCRIPTION = "Removes integration on partner side\n\nOfficial SmartRecruiters endpoint: DELETE /integrations/companies/{companyId} from assessment-partner-app.json.";
    protected const PARAMETERS = [
        "company_id" => [
            "type" => "string",
            "required" => true,
            "description" => "id of company with integration",
        ],
    ];
    protected const METHOD = "DELETE";
    protected const BASE_URL = "https://your.domain.com";
    protected const PATH = "/integrations/companies/{companyId}";
    protected const PATH_PARAMS = [
        "companyId" => "company_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
