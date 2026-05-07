<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Get consent decisions.
 *
 * Maps to job-applications-api.json endpoint GET /job-applications/{jobApplicationId}/consents.
 */
class SmartRecruitersJobApplicationsJobApplicationsGetConsentDecision extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_job_applications_job_applications_get_consent_decision";
    protected const DESCRIPTION = "Get consent decisions\n\nOfficial SmartRecruiters endpoint: GET /job-applications/{jobApplicationId}/consents from job-applications-api.json.";
    protected const PARAMETERS = [
        "job_application_id" => [
            "type" => "string",
            "required" => true,
            "description" => "ID of job application",
        ],
    ];
    protected const METHOD = "GET";
    protected const BASE_URL = "https://api.smartrecruiters.com/job-applications-api/v202112";
    protected const PATH = "/job-applications/{jobApplicationId}/consents";
    protected const PATH_PARAMS = [
        "jobApplicationId" => "job_application_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
