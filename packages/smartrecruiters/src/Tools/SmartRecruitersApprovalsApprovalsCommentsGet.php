<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Get comments for given approval request.
 *
 * Maps to approvals-api.json endpoint GET /approvals/{approvalRequestId}/comments.
 */
class SmartRecruitersApprovalsApprovalsCommentsGet extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_approvals_approvals_comments_get";
    protected const DESCRIPTION = "Get comments for given approval request\n\nOfficial SmartRecruiters endpoint: GET /approvals/{approvalRequestId}/comments from approvals-api.json.";
    protected const PARAMETERS = [
        "approval_request_id" => [
            "type" => "string",
            "required" => true,
            "description" => "Approval request identifier",
        ],
    ];
    protected const METHOD = "GET";
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
