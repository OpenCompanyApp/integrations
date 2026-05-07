<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Get a candidate's attachment..
 *
 * Maps to candidates-api.json endpoint GET /candidates/{id}/attachments/{attachmentId}.
 */
class SmartRecruitersCandidatesCandidatesAttachmentsGet extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_candidates_candidates_attachments_get";
    protected const DESCRIPTION = "Get a candidate's attachment.\n\nOfficial SmartRecruiters endpoint: GET /candidates/{id}/attachments/{attachmentId} from candidates-api.json.";
    protected const PARAMETERS = [
        "id" => [
            "type" => "string",
            "required" => true,
            "description" => "candidate identifier",
        ],
        "attachment_id" => [
            "type" => "string",
            "required" => true,
            "description" => "Identifier of an attachment",
        ],
    ];
    protected const METHOD = "GET";
    protected const BASE_URL = "https://api.smartrecruiters.com";
    protected const PATH = "/candidates/{id}/attachments/{attachmentId}";
    protected const PATH_PARAMS = [
        "id" => "id",
        "attachmentId" => "attachment_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
