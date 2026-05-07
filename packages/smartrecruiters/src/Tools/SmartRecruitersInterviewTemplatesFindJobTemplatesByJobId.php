<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Finds job level interview templates for a job.
 *
 * Maps to interview-templates.json endpoint GET /job-templates/jobs/{jobId}.
 */
class SmartRecruitersInterviewTemplatesFindJobTemplatesByJobId extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_interview_templates_find_job_templates_by_job_id";
    protected const DESCRIPTION = "Finds job level interview templates for a job\n\nOfficial SmartRecruiters endpoint: GET /job-templates/jobs/{jobId} from interview-templates.json.";
    protected const PARAMETERS = [
        "job_id" => [
            "type" => "string",
            "required" => true,
            "description" => "Job id",
        ],
    ];
    protected const METHOD = "GET";
    protected const BASE_URL = "https://api.smartrecruiters.com/interview-templates";
    protected const PATH = "/job-templates/jobs/{jobId}";
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
