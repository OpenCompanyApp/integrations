<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Changes no-show value in a timeslot.
 *
 * Maps to interviews.json endpoint PATCH /interviews/{interviewId}/timeslots/{timeslotId}/noshow.
 */
class SmartRecruitersInterviewsTimeslotsPatchNoshow extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_interviews_timeslots_patch_noshow";
    protected const DESCRIPTION = "Changes no-show value in a timeslot\n\nOfficial SmartRecruiters endpoint: PATCH /interviews/{interviewId}/timeslots/{timeslotId}/noshow from interviews.json.";
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
        "value" => [
            "type" => "boolean",
            "required" => true,
            "description" => "New no-show value",
        ],
    ];
    protected const METHOD = "PATCH";
    protected const BASE_URL = "https://api.smartrecruiters.com/interviews-api/v201904";
    protected const PATH = "/interviews/{interviewId}/timeslots/{timeslotId}/noshow";
    protected const PATH_PARAMS = [
        "interviewId" => "interview_id",
        "timeslotId" => "timeslot_id",
    ];
    protected const QUERY_PARAMS = [
        "value" => "value",
    ];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
