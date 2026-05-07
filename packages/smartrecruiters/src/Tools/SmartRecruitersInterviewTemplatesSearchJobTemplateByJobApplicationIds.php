<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Finds job level interview templates by job application IDs.
 *
 * Maps to interview-templates.json endpoint POST /job-templates/jobs/{jobId}/search.
 */
class SmartRecruitersInterviewTemplatesSearchJobTemplateByJobApplicationIds extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_interview_templates_search_job_template_by_job_application_ids";
    protected const DESCRIPTION = "Finds job level interview templates by job application IDs\n\nOfficial SmartRecruiters endpoint: POST /job-templates/jobs/{jobId}/search from interview-templates.json.";
    protected const PARAMETERS = [
        "job_id" => [
            "type" => "string",
            "required" => true,
            "description" => "Job id",
        ],
        "body" => [
            "type" => "object",
            "required" => true,
            "description" => "Request body matching the official SmartRecruiters interview-templates.json schema for Finds job level interview templates by job application IDs.",
        ],
    ];
    protected const METHOD = "POST";
    protected const BASE_URL = "https://api.smartrecruiters.com/interview-templates";
    protected const PATH = "/job-templates/jobs/{jobId}/search";
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
