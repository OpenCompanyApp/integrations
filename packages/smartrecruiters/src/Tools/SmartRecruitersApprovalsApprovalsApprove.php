<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Approve the approval request by id.
 *
 * Maps to approvals-api.json endpoint POST /approvals/{approvalRequestId}/approve-decisions.
 */
class SmartRecruitersApprovalsApprovalsApprove extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_approvals_approvals_approve";
    protected const DESCRIPTION = "Approve the approval request by id\n\nOfficial SmartRecruiters endpoint: POST /approvals/{approvalRequestId}/approve-decisions from approvals-api.json.";
    protected const PARAMETERS = [
        "approval_request_id" => [
            "type" => "string",
            "required" => true,
            "description" => "Approval request identifier",
        ],
        "body" => [
            "type" => "object",
            "required" => false,
            "description" => "Request body matching the official SmartRecruiters approvals-api.json schema for Approve the approval request by id.",
        ],
    ];
    protected const METHOD = "POST";
    protected const BASE_URL = "https://api.smartrecruiters.com/approvals-api/v201910";
    protected const PATH = "/approvals/{approvalRequestId}/approve-decisions";
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
