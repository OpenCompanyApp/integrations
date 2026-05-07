<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Modifies an interview.
 *
 * Maps to interviews.json endpoint PATCH /interviews/{interviewId}.
 */
class SmartRecruitersInterviewsInterviewsUpdate extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_interviews_interviews_update";
    protected const DESCRIPTION = "Modifies an interview\n\nOfficial SmartRecruiters endpoint: PATCH /interviews/{interviewId} from interviews.json.";
    protected const PARAMETERS = [
        "interview_id" => [
            "type" => "string",
            "required" => true,
            "description" => "ID of the interview",
        ],
        "body" => [
            "type" => "object",
            "required" => true,
            "description" => "Interview to be updated",
        ],
    ];
    protected const METHOD = "PATCH";
    protected const BASE_URL = "https://api.smartrecruiters.com/interviews-api/v201904";
    protected const PATH = "/interviews/{interviewId}";
    protected const PATH_PARAMS = [
        "interviewId" => "interview_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
