<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Create interview template..
 *
 * Maps to interview-templates.json endpoint POST /interview/templates.
 */
class SmartRecruitersInterviewTemplatesCreateInterviewTemplate extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_interview_templates_create_interview_template";
    protected const DESCRIPTION = "Create interview template.\n\nOfficial SmartRecruiters endpoint: POST /interview/templates from interview-templates.json.";
    protected const PARAMETERS = [
        "body" => [
            "type" => "object",
            "required" => true,
            "description" => "Request body matching the official SmartRecruiters interview-templates.json schema for Create interview template..",
        ],
    ];
    protected const METHOD = "POST";
    protected const BASE_URL = "https://api.smartrecruiters.com/interview-templates";
    protected const PATH = "/interview/templates";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
