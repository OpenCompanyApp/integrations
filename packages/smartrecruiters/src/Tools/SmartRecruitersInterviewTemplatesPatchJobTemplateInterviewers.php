<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Patches job level interview template's interviewers pool..
 *
 * Maps to interview-templates.json endpoint PATCH /job-templates/{jobInterviewTemplateId}.
 */
class SmartRecruitersInterviewTemplatesPatchJobTemplateInterviewers extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_interview_templates_patch_job_template_interviewers";
    protected const DESCRIPTION = "Patches job level interview template's interviewers pool.\n\nOfficial SmartRecruiters endpoint: PATCH /job-templates/{jobInterviewTemplateId} from interview-templates.json.";
    protected const PARAMETERS = [
        "job_interview_template_id" => [
            "type" => "string",
            "required" => true,
            "description" => "job level interview template id",
        ],
        "body" => [
            "type" => "object",
            "required" => true,
            "description" => "Request body matching the official SmartRecruiters interview-templates.json schema for Patches job level interview template's interviewers pool..",
        ],
    ];
    protected const METHOD = "PATCH";
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
