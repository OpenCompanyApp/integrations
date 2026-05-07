<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Removes interview type with given name.
 *
 * Maps to interviews.json endpoint DELETE /interview-types/{interviewType}.
 */
class SmartRecruitersInterviewsTypesDelete extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_interviews_types_delete";
    protected const DESCRIPTION = "Removes interview type with given name\n\nOfficial SmartRecruiters endpoint: DELETE /interview-types/{interviewType} from interviews.json.";
    protected const PARAMETERS = [
        "interview_type" => [
            "type" => "string",
            "required" => true,
            "description" => "Interview type name",
        ],
    ];
    protected const METHOD = "DELETE";
    protected const BASE_URL = "https://api.smartrecruiters.com/interviews-api/v201904";
    protected const PATH = "/interview-types/{interviewType}";
    protected const PATH_PARAMS = [
        "interviewType" => "interview_type",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
