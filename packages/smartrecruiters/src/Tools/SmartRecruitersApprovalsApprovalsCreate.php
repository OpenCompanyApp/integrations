<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Create approval request.
 *
 * Maps to approvals-api.json endpoint POST /approvals.
 */
class SmartRecruitersApprovalsApprovalsCreate extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_approvals_approvals_create";
    protected const DESCRIPTION = "Create approval request\n\nOfficial SmartRecruiters endpoint: POST /approvals from approvals-api.json.";
    protected const PARAMETERS = [
        "body" => [
            "type" => "object",
            "required" => false,
            "description" => "Request body matching the official SmartRecruiters approvals-api.json schema for Create approval request.",
        ],
    ];
    protected const METHOD = "POST";
    protected const BASE_URL = "https://api.smartrecruiters.com/approvals-api/v201910";
    protected const PATH = "/approvals";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
