<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Finds job level interview templates for job id, hiring step and hiring stage..
 *
 * Maps to interview-templates.json endpoint GET /job-templates/jobs/{jobId}/hiringStages/{hiringStage}.
 */
class SmartRecruitersInterviewTemplatesFindJobTemplateByHiringState extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_interview_templates_find_job_template_by_hiring_state";
    protected const DESCRIPTION = "Finds job level interview templates for job id, hiring step and hiring stage.\n\nOfficial SmartRecruiters endpoint: GET /job-templates/jobs/{jobId}/hiringStages/{hiringStage} from interview-templates.json.";
    protected const PARAMETERS = [
        "job_id" => [
            "type" => "string",
            "required" => true,
            "description" => "Job id",
        ],
        "hiring_stage" => [
            "type" => "string",
            "required" => true,
            "description" => "Hiring stage",
        ],
        "hiring_step" => [
            "type" => "string",
            "required" => true,
            "description" => "Hiring step",
        ],
    ];
    protected const METHOD = "GET";
    protected const BASE_URL = "https://api.smartrecruiters.com/interview-templates";
    protected const PATH = "/job-templates/jobs/{jobId}/hiringStages/{hiringStage}";
    protected const PATH_PARAMS = [
        "jobId" => "job_id",
        "hiringStage" => "hiring_stage",
    ];
    protected const QUERY_PARAMS = [
        "hiringStep" => "hiring_step",
    ];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
