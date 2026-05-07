<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * updates package result.
 *
 * Maps to assessment-partner-api.json endpoint PATCH /orders/{orderId}/results.
 */
class SmartRecruitersAssessmentPartnerPackageResultUpdate extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_assessment_partner_package_result_update";
    protected const DESCRIPTION = "updates package result\n\nOfficial SmartRecruiters endpoint: PATCH /orders/{orderId}/results from assessment-partner-api.json.";
    protected const PARAMETERS = [
        "order_id" => [
            "type" => "string",
            "required" => true,
            "description" => "Order ID",
        ],
        "body" => [
            "type" => "object",
            "required" => false,
            "description" => "Request body matching the official SmartRecruiters assessment-partner-api.json schema for updates package result.",
        ],
    ];
    protected const METHOD = "PATCH";
    protected const BASE_URL = "https://api.smartrecruiters.com/assessment-api/v202010";
    protected const PATH = "/orders/{orderId}/results";
    protected const PATH_PARAMS = [
        "orderId" => "order_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "bearer";
}
