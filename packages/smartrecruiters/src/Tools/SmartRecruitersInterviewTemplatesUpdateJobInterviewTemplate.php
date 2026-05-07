<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Update job interview template..
 *
 * Maps to interview-templates.json endpoint PUT /interview/templates/job/{jobInterviewTemplateId}.
 */
class SmartRecruitersInterviewTemplatesUpdateJobInterviewTemplate extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_interview_templates_update_job_interview_template";
    protected const DESCRIPTION = "Update job interview template.\n\nOfficial SmartRecruiters endpoint: PUT /interview/templates/job/{jobInterviewTemplateId} from interview-templates.json.";
    protected const PARAMETERS = [
        "job_interview_template_id" => [
            "type" => "string",
            "required" => true,
            "description" => "The job interview template id",
        ],
        "body" => [
            "type" => "object",
            "required" => true,
            "description" => "Request body matching the official SmartRecruiters interview-templates.json schema for Update job interview template..",
        ],
    ];
    protected const METHOD = "PUT";
    protected const BASE_URL = "https://api.smartrecruiters.com/interview-templates";
    protected const PATH = "/interview/templates/job/{jobInterviewTemplateId}";
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
