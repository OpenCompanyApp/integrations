<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Download most recent report file.
 *
 * Maps to reporting-api.json endpoint GET /reports/{reportId}/files/recent/data.
 */
class SmartRecruitersReportingDownloadMostRecentReportFile extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_reporting_download_most_recent_report_file";
    protected const DESCRIPTION = "Download most recent report file\n\nOfficial SmartRecruiters endpoint: GET /reports/{reportId}/files/recent/data from reporting-api.json.";
    protected const PARAMETERS = [
        "report_id" => [
            "type" => "string",
            "required" => true,
            "description" => "Report identifier",
        ],
        "if_none_match" => [
            "type" => "string",
            "required" => false,
            "description" => "Report file ETag to be compared with the most recent report file",
        ],
    ];
    protected const METHOD = "GET";
    protected const BASE_URL = "https://api.smartrecruiters.com/reporting-api/v201804";
    protected const PATH = "/reports/{reportId}/files/recent/data";
    protected const PATH_PARAMS = [
        "reportId" => "report_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [
        "If-None-Match" => "if_none_match",
    ];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
