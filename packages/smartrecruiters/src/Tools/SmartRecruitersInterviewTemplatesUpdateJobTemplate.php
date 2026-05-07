<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Update job level interview template..
 *
 * Maps to interview-templates.json endpoint PUT /job-templates/{jobInterviewTemplateId}.
 */
class SmartRecruitersInterviewTemplatesUpdateJobTemplate extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_interview_templates_update_job_template";
    protected const DESCRIPTION = "Update job level interview template.\n\nOfficial SmartRecruiters endpoint: PUT /job-templates/{jobInterviewTemplateId} from interview-templates.json.";
    protected const PARAMETERS = [
        "job_interview_template_id" => [
            "type" => "string",
            "required" => true,
            "description" => "The job level interview templates id",
        ],
        "body" => [
            "type" => "object",
            "required" => true,
            "description" => "Request body matching the official SmartRecruiters interview-templates.json schema for Update job level interview template..",
        ],
    ];
    protected const METHOD = "PUT";
    protected const BASE_URL = "https://api.smartrecruiters.com/interview-templates";
    protected const PATH = "/job-templates/{jobInterviewTemplateId}";
    protected const PATH_PARAMS = [
        "jobInterviewTemplateId" => "job_interview_template_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
