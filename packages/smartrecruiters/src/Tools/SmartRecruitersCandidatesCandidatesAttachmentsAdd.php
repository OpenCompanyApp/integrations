<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Attach files to a candidate..
 *
 * Maps to candidates-api.json endpoint POST /candidates/{id}/attachments.
 */
class SmartRecruitersCandidatesCandidatesAttachmentsAdd extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_candidates_candidates_attachments_add";
    protected const DESCRIPTION = "Attach files to a candidate.\n\nOfficial SmartRecruiters endpoint: POST /candidates/{id}/attachments from candidates-api.json.";
    protected const PARAMETERS = [
        "id" => [
            "type" => "string",
            "required" => true,
            "description" => "candidate identifier",
        ],
        "body" => [
            "type" => "object",
            "required" => false,
            "description" => "Request body matching the official SmartRecruiters candidates-api.json schema for Attach files to a candidate..",
        ],
    ];
    protected const METHOD = "POST";
    protected const BASE_URL = "https://api.smartrecruiters.com";
    protected const PATH = "/candidates/{id}/attachments";
    protected const PATH_PARAMS = [
        "id" => "id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "multipart";
    protected const AUTH_MODE = "either";
}
