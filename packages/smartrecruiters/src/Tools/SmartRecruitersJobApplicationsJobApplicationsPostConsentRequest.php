<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Request consent for a job application.
 *
 * Maps to job-applications-api.json endpoint POST /job-applications/{jobApplicationId}/consent-request.
 */
class SmartRecruitersJobApplicationsJobApplicationsPostConsentRequest extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_job_applications_job_applications_post_consent_request";
    protected const DESCRIPTION = "Request consent for a job application\n\nOfficial SmartRecruiters endpoint: POST /job-applications/{jobApplicationId}/consent-request from job-applications-api.json.";
    protected const PARAMETERS = [
        "job_application_id" => [
            "type" => "string",
            "required" => true,
            "description" => "ID of job application",
        ],
    ];
    protected const METHOD = "POST";
    protected const BASE_URL = "https://api.smartrecruiters.com/job-applications-api/v202112";
    protected const PATH = "/job-applications/{jobApplicationId}/consent-request";
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
