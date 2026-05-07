<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Find interview templates for the job.
 *
 * Maps to interview-templates.json endpoint GET /interview/templates/jobs/{jobId}.
 */
class SmartRecruitersInterviewTemplatesGetJobInterviewTemplates extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_interview_templates_get_job_interview_templates";
    protected const DESCRIPTION = "Find interview templates for the job\n\nOfficial SmartRecruiters endpoint: GET /interview/templates/jobs/{jobId} from interview-templates.json.";
    protected const PARAMETERS = [
        "job_id" => [
            "type" => "string",
            "required" => true,
            "description" => "The job id",
        ],
    ];
    protected const METHOD = "GET";
    protected const BASE_URL = "https://api.smartrecruiters.com/interview-templates";
    protected const PATH = "/interview/templates/jobs/{jobId}";
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
