<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Update a candidate's status on primary assignment.
 *
 * Maps to candidates-api.json endpoint PUT /candidates/{id}/status.
 */
class SmartRecruitersCandidatesCandidatesStatusUpdatePrimary extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_candidates_candidates_status_update_primary";
    protected const DESCRIPTION = "Update a candidate's status on primary assignment\n\nOfficial SmartRecruiters endpoint: PUT /candidates/{id}/status from candidates-api.json.";
    protected const PARAMETERS = [
        "id" => [
            "type" => "string",
            "required" => true,
            "description" => "candidate identifier",
        ],
        "body" => [
            "type" => "object",
            "required" => false,
            "description" => "Candidate Status to be set",
        ],
    ];
    protected const METHOD = "PUT";
    protected const BASE_URL = "https://api.smartrecruiters.com";
    protected const PATH = "/candidates/{id}/status";
    protected const PATH_PARAMS = [
        "id" => "id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
