<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Get interview templates for the current company..
 *
 * Maps to interview-templates.json endpoint GET /templates.
 */
class SmartRecruitersInterviewTemplatesGetTemplates extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_interview_templates_get_templates";
    protected const DESCRIPTION = "Get interview templates for the current company.\n\nOfficial SmartRecruiters endpoint: GET /templates from interview-templates.json.";
    protected const PARAMETERS = [
        "page" => [
            "type" => "integer",
            "required" => false,
            "description" => "Page number beginning from 0",
        ],
        "page_size" => [
            "type" => "integer",
            "required" => false,
            "description" => "Page size default is 20",
        ],
        "hiring_stage" => [
            "type" => "string",
            "enum" => [
                "NEW",
                "IN_PROGRESS",
                "INTERVIEW",
                "OFFER",
            ],
            "required" => false,
            "description" => "Hiring stage (if used both Hiring stage and Hiring step must be used)",
        ],
        "hiring_step" => [
            "type" => "string",
            "required" => false,
            "description" => "Hiring step (if used both Hiring stage and Hiring step must be used)",
        ],
        "type" => [
            "type" => "string",
            "enum" => [
                "INDIVIDUAL",
                "GROUP",
            ],
            "required" => false,
            "description" => "Type of the template (if not passed in then will return all types)",
        ],
        "search" => [
            "type" => "string",
            "required" => false,
            "description" => "query parameter `search`.",
        ],
    ];
    protected const METHOD = "GET";
    protected const BASE_URL = "https://api.smartrecruiters.com/interview-templates";
    protected const PATH = "/templates";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        "page" => "page",
        "pageSize" => "page_size",
        "hiringStage" => "hiring_stage",
        "hiringStep" => "hiring_step",
        "type" => "type",
        "search" => "search",
    ];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
