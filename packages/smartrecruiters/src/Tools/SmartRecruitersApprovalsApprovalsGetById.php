<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Get approval request by id.
 *
 * Maps to approvals-api.json endpoint GET /approvals/{approvalRequestId}.
 */
class SmartRecruitersApprovalsApprovalsGetById extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_approvals_approvals_get_by_id";
    protected const DESCRIPTION = "Get approval request by id\n\nOfficial SmartRecruiters endpoint: GET /approvals/{approvalRequestId} from approvals-api.json.";
    protected const PARAMETERS = [
        "approval_request_id" => [
            "type" => "string",
            "required" => true,
            "description" => "Approval request identifier",
        ],
    ];
    protected const METHOD = "GET";
    protected const BASE_URL = "https://api.smartrecruiters.com/approvals-api/v201910";
    protected const PATH = "/approvals/{approvalRequestId}";
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
