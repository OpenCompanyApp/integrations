<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Add tags to a candidate.
 *
 * Maps to candidates-api.json endpoint POST /candidates/{id}/tags.
 */
class SmartRecruitersCandidatesCandidatesTagsAdd extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_candidates_candidates_tags_add";
    protected const DESCRIPTION = "Add tags to a candidate\n\nOfficial SmartRecruiters endpoint: POST /candidates/{id}/tags from candidates-api.json.";
    protected const PARAMETERS = [
        "id" => [
            "type" => "string",
            "required" => true,
            "description" => "candidate identifier",
        ],
        "body" => [
            "type" => "object",
            "required" => true,
            "description" => "Tags to be added.",
        ],
    ];
    protected const METHOD = "POST";
    protected const BASE_URL = "https://api.smartrecruiters.com";
    protected const PATH = "/candidates/{id}/tags";
    protected const PATH_PARAMS = [
        "id" => "id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
