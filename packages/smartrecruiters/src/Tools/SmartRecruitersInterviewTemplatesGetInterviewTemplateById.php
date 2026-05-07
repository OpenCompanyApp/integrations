<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Get interview template by id..
 *
 * Maps to interview-templates.json endpoint GET /interview/templates/{id}.
 */
class SmartRecruitersInterviewTemplatesGetInterviewTemplateById extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_interview_templates_get_interview_template_by_id";
    protected const DESCRIPTION = "Get interview template by id.\n\nOfficial SmartRecruiters endpoint: GET /interview/templates/{id} from interview-templates.json.";
    protected const PARAMETERS = [
        "id" => [
            "type" => "string",
            "required" => true,
            "description" => "The interview template id.",
        ],
    ];
    protected const METHOD = "GET";
    protected const BASE_URL = "https://api.smartrecruiters.com/interview-templates";
    protected const PATH = "/interview/templates/{id}";
    protected const PATH_PARAMS = [
        "id" => "id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
