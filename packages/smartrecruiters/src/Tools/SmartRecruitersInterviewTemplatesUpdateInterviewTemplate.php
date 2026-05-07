<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Update interview template by id..
 *
 * Maps to interview-templates.json endpoint PUT /interview/templates/{id}.
 */
class SmartRecruitersInterviewTemplatesUpdateInterviewTemplate extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_interview_templates_update_interview_template";
    protected const DESCRIPTION = "Update interview template by id.\n\nOfficial SmartRecruiters endpoint: PUT /interview/templates/{id} from interview-templates.json.";
    protected const PARAMETERS = [
        "id" => [
            "type" => "string",
            "required" => true,
            "description" => "The interview template id.",
        ],
        "body" => [
            "type" => "object",
            "required" => true,
            "description" => "Request body matching the official SmartRecruiters interview-templates.json schema for Update interview template by id..",
        ],
    ];
    protected const METHOD = "PUT";
    protected const BASE_URL = "https://api.smartrecruiters.com/interview-templates";
    protected const PATH = "/interview/templates/{id}";
    protected const PATH_PARAMS = [
        "id" => "id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
