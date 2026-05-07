<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Parse a resume.
 *
 * Maps to candidates-api.json endpoint POST /candidates/cv/parse.
 */
class SmartRecruitersCandidatesCandidatesResumeParse extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_candidates_candidates_resume_parse";
    protected const DESCRIPTION = "Parse a resume\n\nOfficial SmartRecruiters endpoint: POST /candidates/cv/parse from candidates-api.json.";
    protected const PARAMETERS = [
        "body" => [
            "type" => "object",
            "required" => false,
            "description" => "Request body matching the official SmartRecruiters candidates-api.json schema for Parse a resume.",
        ],
    ];
    protected const METHOD = "POST";
    protected const BASE_URL = "https://api.smartrecruiters.com";
    protected const PATH = "/candidates/cv/parse";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "multipart";
    protected const AUTH_MODE = "either";
}
