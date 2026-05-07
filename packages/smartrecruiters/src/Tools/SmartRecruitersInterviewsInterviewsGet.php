<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Retrieves an interview.
 *
 * Maps to interviews.json endpoint GET /interviews/{interviewId}.
 */
class SmartRecruitersInterviewsInterviewsGet extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_interviews_interviews_get";
    protected const DESCRIPTION = "Retrieves an interview\n\nOfficial SmartRecruiters endpoint: GET /interviews/{interviewId} from interviews.json.";
    protected const PARAMETERS = [
        "interview_id" => [
            "type" => "string",
            "required" => true,
            "description" => "ID of the interview",
        ],
    ];
    protected const METHOD = "GET";
    protected const BASE_URL = "https://api.smartrecruiters.com/interviews-api/v201904";
    protected const PATH = "/interviews/{interviewId}";
    protected const PATH_PARAMS = [
        "interviewId" => "interview_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
