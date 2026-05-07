<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Changes a candidate's status..
 *
 * Maps to interviews.json endpoint PUT /interviews/{interviewId}/candidate/status.
 */
class SmartRecruitersInterviewsStatusesCandidatePut extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_interviews_statuses_candidate_put";
    protected const DESCRIPTION = "Changes a candidate's status.\n\nOfficial SmartRecruiters endpoint: PUT /interviews/{interviewId}/candidate/status from interviews.json.";
    protected const PARAMETERS = [
        "interview_id" => [
            "type" => "string",
            "required" => true,
            "description" => "ID of the interview",
        ],
        "body" => [
            "type" => "object",
            "required" => true,
            "description" => "New candidate's status",
        ],
    ];
    protected const METHOD = "PUT";
    protected const BASE_URL = "https://api.smartrecruiters.com/interviews-api/v201904";
    protected const PATH = "/interviews/{interviewId}/candidate/status";
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
