<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Get managed hiring process steps for the job..
 *
 * Maps to interview-templates.json endpoint GET /managed-steps/jobs/{jobId}.
 */
class SmartRecruitersInterviewTemplatesGetJobManagedSteps extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_interview_templates_get_job_managed_steps";
    protected const DESCRIPTION = "Get managed hiring process steps for the job.\n\nOfficial SmartRecruiters endpoint: GET /managed-steps/jobs/{jobId} from interview-templates.json.";
    protected const PARAMETERS = [
        "job_id" => [
            "type" => "string",
            "required" => true,
            "description" => "The job id",
        ],
    ];
    protected const METHOD = "GET";
    protected const BASE_URL = "https://api.smartrecruiters.com/interview-templates";
    protected const PATH = "/managed-steps/jobs/{jobId}";
    protected const PATH_PARAMS = [
        "jobId" => "job_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
