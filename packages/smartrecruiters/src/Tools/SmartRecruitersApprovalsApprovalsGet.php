<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Get pending approvals requests where you are an approver..
 *
 * Maps to approvals-api.json endpoint GET /approvals.
 */
class SmartRecruitersApprovalsApprovalsGet extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_approvals_approvals_get";
    protected const DESCRIPTION = "Get pending approvals requests where you are an approver.\n\nOfficial SmartRecruiters endpoint: GET /approvals from approvals-api.json.";
    protected const PARAMETERS = [
        "page_id" => [
            "type" => "string",
            "required" => false,
            "description" => "Identifier for the paged list of approval requests. To get the first page of approval request, leave it blank.",
        ],
    ];
    protected const METHOD = "GET";
    protected const BASE_URL = "https://api.smartrecruiters.com/approvals-api/v201910";
    protected const PATH = "/approvals";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        "pageId" => "page_id",
    ];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
