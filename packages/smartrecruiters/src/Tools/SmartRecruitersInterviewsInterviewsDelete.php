<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Deletes an interview.
 *
 * Maps to interviews.json endpoint DELETE /interviews/{interviewId}.
 */
class SmartRecruitersInterviewsInterviewsDelete extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_interviews_interviews_delete";
    protected const DESCRIPTION = "Deletes an interview\n\nOfficial SmartRecruiters endpoint: DELETE /interviews/{interviewId} from interviews.json.";
    protected const PARAMETERS = [
        "interview_id" => [
            "type" => "string",
            "required" => true,
            "description" => "ID of the interview",
        ],
    ];
    protected const METHOD = "DELETE";
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
