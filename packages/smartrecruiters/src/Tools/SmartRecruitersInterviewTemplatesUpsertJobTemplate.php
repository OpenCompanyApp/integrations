<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Save / replace job level interview templates for job id, hiring step and hiring stage..
 *
 * Maps to interview-templates.json endpoint PUT /job-templates/jobs/{jobId}/hiringStages/{hiringStage}.
 */
class SmartRecruitersInterviewTemplatesUpsertJobTemplate extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_interview_templates_upsert_job_template";
    protected const DESCRIPTION = "Save / replace job level interview templates for job id, hiring step and hiring stage.\n\nOfficial SmartRecruiters endpoint: PUT /job-templates/jobs/{jobId}/hiringStages/{hiringStage} from interview-templates.json.";
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
        "body" => [
            "type" => "object",
            "required" => true,
            "description" => "Request body matching the official SmartRecruiters interview-templates.json schema for Save / replace job level interview templates for job id, hiring step and hiring stage..",
        ],
    ];
    protected const METHOD = "PUT";
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
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
