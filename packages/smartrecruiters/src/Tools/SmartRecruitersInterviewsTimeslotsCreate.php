<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Creates a timeslot.
 *
 * Maps to interviews.json endpoint POST /interviews/{interviewId}/timeslots.
 */
class SmartRecruitersInterviewsTimeslotsCreate extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_interviews_timeslots_create";
    protected const DESCRIPTION = "Creates a timeslot\n\nOfficial SmartRecruiters endpoint: POST /interviews/{interviewId}/timeslots from interviews.json.";
    protected const PARAMETERS = [
        "interview_id" => [
            "type" => "string",
            "required" => true,
            "description" => "ID of the interview",
        ],
        "body" => [
            "type" => "object",
            "required" => true,
            "description" => "Timeslot to be added",
        ],
    ];
    protected const METHOD = "POST";
    protected const BASE_URL = "https://api.smartrecruiters.com/interviews-api/v201904";
    protected const PATH = "/interviews/{interviewId}/timeslots";
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
