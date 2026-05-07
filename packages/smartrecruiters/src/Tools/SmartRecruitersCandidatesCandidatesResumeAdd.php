<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Parse a resume, create a candidate and assign to a Talent Pool..
 *
 * Maps to candidates-api.json endpoint POST /candidates/cv.
 */
class SmartRecruitersCandidatesCandidatesResumeAdd extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_candidates_candidates_resume_add";
    protected const DESCRIPTION = "Parse a resume, create a candidate and assign to a Talent Pool.\n\nOfficial SmartRecruiters endpoint: POST /candidates/cv from candidates-api.json.";
    protected const PARAMETERS = [
        "body" => [
            "type" => "object",
            "required" => false,
            "description" => "Request body matching the official SmartRecruiters candidates-api.json schema for Parse a resume, create a candidate and assign to a Talent Pool..",
        ],
    ];
    protected const METHOD = "POST";
    protected const BASE_URL = "https://api.smartrecruiters.com";
    protected const PATH = "/candidates/cv";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "multipart";
    protected const AUTH_MODE = "either";
}
