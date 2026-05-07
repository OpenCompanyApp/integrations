<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Creates an interview.
 *
 * Maps to interviews.json endpoint POST /interviews.
 */
class SmartRecruitersInterviewsInterviewsCreate extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_interviews_interviews_create";
    protected const DESCRIPTION = "Creates an interview\n\nOfficial SmartRecruiters endpoint: POST /interviews from interviews.json.";
    protected const PARAMETERS = [
        "body" => [
            "type" => "object",
            "required" => true,
            "description" => "Interview to be added",
        ],
    ];
    protected const METHOD = "POST";
    protected const BASE_URL = "https://api.smartrecruiters.com/interviews-api/v201904";
    protected const PATH = "/interviews";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
