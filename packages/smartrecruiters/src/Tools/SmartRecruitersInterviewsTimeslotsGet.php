<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Retrieves a timeslot.
 *
 * Maps to interviews.json endpoint GET /interviews/{interviewId}/timeslots/{timeslotId}.
 */
class SmartRecruitersInterviewsTimeslotsGet extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_interviews_timeslots_get";
    protected const DESCRIPTION = "Retrieves a timeslot\n\nOfficial SmartRecruiters endpoint: GET /interviews/{interviewId}/timeslots/{timeslotId} from interviews.json.";
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
    ];
    protected const METHOD = "GET";
    protected const BASE_URL = "https://api.smartrecruiters.com/interviews-api/v201904";
    protected const PATH = "/interviews/{interviewId}/timeslots/{timeslotId}";
    protected const PATH_PARAMS = [
        "interviewId" => "interview_id",
        "timeslotId" => "timeslot_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
