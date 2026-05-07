<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Get list candidate's attachments..
 *
 * Maps to candidates-api.json endpoint GET /candidates/{id}/attachments.
 */
class SmartRecruitersCandidatesCandidatesAttachmentsList extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_candidates_candidates_attachments_list";
    protected const DESCRIPTION = "Get list candidate's attachments.\n\nOfficial SmartRecruiters endpoint: GET /candidates/{id}/attachments from candidates-api.json.";
    protected const PARAMETERS = [
        "id" => [
            "type" => "string",
            "required" => true,
            "description" => "candidate identifier",
        ],
    ];
    protected const METHOD = "GET";
    protected const BASE_URL = "https://api.smartrecruiters.com";
    protected const PATH = "/candidates/{id}/attachments";
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
