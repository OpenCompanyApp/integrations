<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * saves configuration for partner.
 *
 * Maps to assessment-partner-api.json endpoint PUT /partner/configuration.
 */
class SmartRecruitersAssessmentPartnerSavePartnerConfig extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_assessment_partner_save_partner_config";
    protected const DESCRIPTION = "saves configuration for partner\n\nOfficial SmartRecruiters endpoint: PUT /partner/configuration from assessment-partner-api.json.";
    protected const PARAMETERS = [
        "body" => [
            "type" => "object",
            "required" => false,
            "description" => "Request body matching the official SmartRecruiters assessment-partner-api.json schema for saves configuration for partner.",
        ],
    ];
    protected const METHOD = "PUT";
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
