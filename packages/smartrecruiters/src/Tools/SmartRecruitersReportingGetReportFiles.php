<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Get report files.
 *
 * Maps to reporting-api.json endpoint GET /reports/{reportId}/files.
 */
class SmartRecruitersReportingGetReportFiles extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_reporting_get_report_files";
    protected const DESCRIPTION = "Get report files\n\nOfficial SmartRecruiters endpoint: GET /reports/{reportId}/files from reporting-api.json.";
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
        "report_id" => [
            "type" => "string",
            "required" => true,
            "description" => "Report identifier",
        ],
    ];
    protected const METHOD = "GET";
    protected const BASE_URL = "https://api.smartrecruiters.com/reporting-api/v201804";
    protected const PATH = "/reports/{reportId}/files";
    protected const PATH_PARAMS = [
        "reportId" => "report_id",
    ];
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
