<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Changes a interviewer's status in given timeslot.
 *
 * Maps to interviews.json endpoint PUT /interviews/{interviewId}/timeslots/{timeslotId}/interviewers/{userId}/status.
 */
class SmartRecruitersInterviewsStatusesInterviewerPut extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_interviews_statuses_interviewer_put";
    protected const DESCRIPTION = "Changes a interviewer's status in given timeslot\n\nOfficial SmartRecruiters endpoint: PUT /interviews/{interviewId}/timeslots/{timeslotId}/interviewers/{userId}/status from interviews.json.";
    protected const PARAMETERS = [
        "interview_id" => [
            "type" => "string",
            "required" => true,
            "description" => "ID of the interview",
        ],
        "timeslot_id" => [
            "type" => "string",
            "required" => true,
            "description" => "ID of the timeslot",
        ],
        "user_id" => [
            "type" => "string",
            "required" => true,
            "description" => "ID of the user",
        ],
        "body" => [
            "type" => "object",
            "required" => true,
            "description" => "New interviewer's status",
        ],
    ];
    protected const METHOD = "PUT";
    protected const BASE_URL = "https://api.smartrecruiters.com/interviews-api/v201904";
    protected const PATH = "/interviews/{interviewId}/timeslots/{timeslotId}/interviewers/{userId}/status";
    protected const PATH_PARAMS = [
        "interviewId" => "interview_id",
        "timeslotId" => "timeslot_id",
        "userId" => "user_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
