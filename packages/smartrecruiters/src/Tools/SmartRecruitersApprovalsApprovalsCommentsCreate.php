<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Add comment to given approval request.
 *
 * Maps to approvals-api.json endpoint POST /approvals/{approvalRequestId}/comments.
 */
class SmartRecruitersApprovalsApprovalsCommentsCreate extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_approvals_approvals_comments_create";
    protected const DESCRIPTION = "Add comment to given approval request\n\nOfficial SmartRecruiters endpoint: POST /approvals/{approvalRequestId}/comments from approvals-api.json.";
    protected const PARAMETERS = [
        "approval_request_id" => [
            "type" => "string",
            "required" => true,
            "description" => "Approval request identifier",
        ],
        "body" => [
            "type" => "object",
            "required" => false,
            "description" => "Request body matching the official SmartRecruiters approvals-api.json schema for Add comment to given approval request.",
        ],
    ];
    protected const METHOD = "POST";
    protected const BASE_URL = "https://api.smartrecruiters.com/approvals-api/v201910";
    protected const PATH = "/approvals/{approvalRequestId}/comments";
    protected const PATH_PARAMS = [
        "approvalRequestId" => "approval_request_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
