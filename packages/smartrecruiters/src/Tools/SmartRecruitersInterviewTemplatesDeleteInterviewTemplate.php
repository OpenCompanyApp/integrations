<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Remove interview template by id..
 *
 * Maps to interview-templates.json endpoint DELETE /interview/templates/{id}.
 */
class SmartRecruitersInterviewTemplatesDeleteInterviewTemplate extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_interview_templates_delete_interview_template";
    protected const DESCRIPTION = "Remove interview template by id.\n\nOfficial SmartRecruiters endpoint: DELETE /interview/templates/{id} from interview-templates.json.";
    protected const PARAMETERS = [
        "id" => [
            "type" => "string",
            "required" => true,
            "description" => "The interview template id.",
        ],
    ];
    protected const METHOD = "DELETE";
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
