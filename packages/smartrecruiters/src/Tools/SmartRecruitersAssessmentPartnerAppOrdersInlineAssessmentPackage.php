<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Orders inline assessment package for candidate.
 *
 * Maps to assessment-partner-app.json endpoint POST /packages/inline/orders.
 */
class SmartRecruitersAssessmentPartnerAppOrdersInlineAssessmentPackage extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_assessment_partner_app_orders_inline_assessment_package";
    protected const DESCRIPTION = "Orders inline assessment package for candidate\n\nOfficial SmartRecruiters endpoint: POST /packages/inline/orders from assessment-partner-app.json.";
    protected const PARAMETERS = [
        "body" => [
            "type" => "object",
            "required" => false,
            "description" => "Request body matching the official SmartRecruiters assessment-partner-app.json schema for Orders inline assessment package for candidate.",
        ],
    ];
    protected const METHOD = "POST";
    protected const BASE_URL = "https://your.domain.com";
    protected const PATH = "/packages/inline/orders";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "bearer";
}
