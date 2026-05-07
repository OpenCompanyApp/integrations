<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Removes interview template..
 *
 * Maps to interview-templates.json endpoint DELETE /templates/{id}.
 */
class SmartRecruitersInterviewTemplatesDeleteTemplate extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_interview_templates_delete_template";
    protected const DESCRIPTION = "Removes interview template.\n\nOfficial SmartRecruiters endpoint: DELETE /templates/{id} from interview-templates.json.";
    protected const PARAMETERS = [
        "id" => [
            "type" => "string",
            "required" => true,
            "description" => "path parameter `id`.",
        ],
    ];
    protected const METHOD = "DELETE";
    protected const BASE_URL = "https://api.smartrecruiters.com/interview-templates";
    protected const PATH = "/templates/{id}";
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
