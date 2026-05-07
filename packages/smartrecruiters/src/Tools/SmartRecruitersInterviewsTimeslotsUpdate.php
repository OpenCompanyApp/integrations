<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Modifies a timeslot.
 *
 * Maps to interviews.json endpoint PATCH /interviews/{interviewId}/timeslots/{timeslotId}.
 */
class SmartRecruitersInterviewsTimeslotsUpdate extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_interviews_timeslots_update";
    protected const DESCRIPTION = "Modifies a timeslot\n\nOfficial SmartRecruiters endpoint: PATCH /interviews/{interviewId}/timeslots/{timeslotId} from interviews.json.";
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
        "body" => [
            "type" => "object",
            "required" => true,
            "description" => "Timeslot to be updated",
        ],
    ];
    protected const METHOD = "PATCH";
    protected const BASE_URL = "https://api.smartrecruiters.com/interviews-api/v201904";
    protected const PATH = "/interviews/{interviewId}/timeslots/{timeslotId}";
    protected const PATH_PARAMS = [
        "interviewId" => "interview_id",
        "timeslotId" => "timeslot_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
