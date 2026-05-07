<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Delete attachment..
 *
 * Maps to candidates-api.json endpoint DELETE /candidates/attachments/{attachmentId}.
 */
class SmartRecruitersCandidatesCandidatesAttachmentsDeleteForJob extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_candidates_candidates_attachments_delete_for_job";
    protected const DESCRIPTION = "Delete attachment.\n\nOfficial SmartRecruiters endpoint: DELETE /candidates/attachments/{attachmentId} from candidates-api.json.";
    protected const PARAMETERS = [
        "attachment_id" => [
            "type" => "string",
            "required" => true,
            "description" => "attachment identifier",
        ],
    ];
    protected const METHOD = "DELETE";
    protected const BASE_URL = "https://api.smartrecruiters.com";
    protected const PATH = "/candidates/attachments/{attachmentId}";
    protected const PATH_PARAMS = [
        "attachmentId" => "attachment_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
