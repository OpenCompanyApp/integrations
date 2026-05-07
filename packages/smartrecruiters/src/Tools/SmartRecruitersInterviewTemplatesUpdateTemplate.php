<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Update interview template..
 *
 * Maps to interview-templates.json endpoint PUT /templates/{id}.
 */
class SmartRecruitersInterviewTemplatesUpdateTemplate extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_interview_templates_update_template";
    protected const DESCRIPTION = "Update interview template.\n\nOfficial SmartRecruiters endpoint: PUT /templates/{id} from interview-templates.json.";
    protected const PARAMETERS = [
        "id" => [
            "type" => "string",
            "required" => true,
            "description" => "path parameter `id`.",
        ],
        "body" => [
            "type" => "object",
            "required" => true,
            "description" => "Request body matching the official SmartRecruiters interview-templates.json schema for Update interview template..",
        ],
    ];
    protected const METHOD = "PUT";
    protected const BASE_URL = "https://api.smartrecruiters.com/interview-templates";
    protected const PATH = "/templates/{id}";
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
