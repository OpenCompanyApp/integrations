<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Find interview templates for job application id..
 *
 * Maps to interview-templates.json endpoint GET /interview/templates/job-applications/{applicationId}.
 */
class SmartRecruitersInterviewTemplatesGetJobApplicationInterviewTemplates extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_interview_templates_get_job_application_interview_templates";
    protected const DESCRIPTION = "Find interview templates for job application id.\n\nOfficial SmartRecruiters endpoint: GET /interview/templates/job-applications/{applicationId} from interview-templates.json.";
    protected const PARAMETERS = [
        "application_id" => [
            "type" => "string",
            "required" => true,
            "description" => "The job application id",
        ],
    ];
    protected const METHOD = "GET";
    protected const BASE_URL = "https://api.smartrecruiters.com/interview-templates";
    protected const PATH = "/interview/templates/job-applications/{applicationId}";
    protected const PATH_PARAMS = [
        "applicationId" => "application_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
