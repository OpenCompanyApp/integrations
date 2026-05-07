<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Update managed steps for the job..
 *
 * Maps to interview-templates.json endpoint PUT /managed-steps/jobs/{jobId}.
 */
class SmartRecruitersInterviewTemplatesUpdateJobManagedSteps extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_interview_templates_update_job_managed_steps";
    protected const DESCRIPTION = "Update managed steps for the job.\n\nOfficial SmartRecruiters endpoint: PUT /managed-steps/jobs/{jobId} from interview-templates.json.";
    protected const PARAMETERS = [
        "job_id" => [
            "type" => "string",
            "required" => true,
            "description" => "The job id",
        ],
        "body" => [
            "type" => "object",
            "required" => true,
            "description" => "Request body matching the official SmartRecruiters interview-templates.json schema for Update managed steps for the job..",
        ],
    ];
    protected const METHOD = "PUT";
    protected const BASE_URL = "https://api.smartrecruiters.com/interview-templates";
    protected const PATH = "/managed-steps/jobs/{jobId}";
    protected const PATH_PARAMS = [
        "jobId" => "job_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
