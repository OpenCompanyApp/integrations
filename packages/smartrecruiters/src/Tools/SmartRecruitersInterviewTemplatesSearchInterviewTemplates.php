<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Search for all interview templates..
 *
 * Maps to interview-templates.json endpoint GET /interview/templates.
 */
class SmartRecruitersInterviewTemplatesSearchInterviewTemplates extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_interview_templates_search_interview_templates";
    protected const DESCRIPTION = "Search for all interview templates.\n\nOfficial SmartRecruiters endpoint: GET /interview/templates from interview-templates.json.";
    protected const PARAMETERS = [
        "page" => [
            "type" => "integer",
            "required" => false,
            "description" => "The page number to retrieve.",
        ],
        "limit" => [
            "type" => "integer",
            "required" => false,
            "description" => "The number of items per page.",
        ],
        "search" => [
            "type" => "string",
            "required" => false,
            "description" => "The search query to filter the results. By default all items are returned.",
        ],
    ];
    protected const METHOD = "GET";
    protected const BASE_URL = "https://api.smartrecruiters.com/interview-templates";
    protected const PATH = "/interview/templates";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        "page" => "page",
        "limit" => "limit",
        "search" => "search",
    ];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
