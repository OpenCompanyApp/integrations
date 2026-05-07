<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Retrieves a list of interviews.
 *
 * Maps to interviews.json endpoint GET /interviews.
 */
class SmartRecruitersInterviewsInterviewsGetList extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_interviews_interviews_get_list";
    protected const DESCRIPTION = "Retrieves a list of interviews\n\nOfficial SmartRecruiters endpoint: GET /interviews from interviews.json.";
    protected const PARAMETERS = [
        "application_id" => [
            "type" => "string",
            "required" => true,
            "description" => "ID of the application",
        ],
    ];
    protected const METHOD = "GET";
    protected const BASE_URL = "https://api.smartrecruiters.com/interviews-api/v201904";
    protected const PATH = "/interviews";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        "applicationId" => "application_id",
    ];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
