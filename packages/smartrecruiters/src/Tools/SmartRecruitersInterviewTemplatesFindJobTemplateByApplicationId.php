<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Finds job level interview templates by job application id.
 *
 * Maps to interview-templates.json endpoint GET /job-templates/job-applications/{applicationId}.
 */
class SmartRecruitersInterviewTemplatesFindJobTemplateByApplicationId extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_interview_templates_find_job_template_by_application_id";
    protected const DESCRIPTION = "Finds job level interview templates by job application id\n\nOfficial SmartRecruiters endpoint: GET /job-templates/job-applications/{applicationId} from interview-templates.json.";
    protected const PARAMETERS = [
        "application_id" => [
            "type" => "string",
            "required" => true,
            "description" => "application id",
        ],
    ];
    protected const METHOD = "GET";
    protected const BASE_URL = "https://api.smartrecruiters.com/interview-templates";
    protected const PATH = "/job-templates/job-applications/{applicationId}";
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
