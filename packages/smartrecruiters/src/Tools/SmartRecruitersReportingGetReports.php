<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Get reports.
 *
 * Maps to reporting-api.json endpoint GET /reports.
 */
class SmartRecruitersReportingGetReports extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_reporting_get_reports";
    protected const DESCRIPTION = "Get reports\n\nOfficial SmartRecruiters endpoint: GET /reports from reporting-api.json.";
    protected const PARAMETERS = [
        "page" => [
            "type" => "string",
            "required" => false,
            "description" => "Opaque page identifier to be returned.",
        ],
        "limit" => [
            "type" => "integer",
            "required" => false,
            "description" => "Number of entities that should be returned per page.",
        ],
    ];
    protected const METHOD = "GET";
    protected const BASE_URL = "https://api.smartrecruiters.com/reporting-api/v201804";
    protected const PATH = "/reports";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        "page" => "page",
        "limit" => "limit",
    ];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
