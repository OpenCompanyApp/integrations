<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Download report file.
 *
 * Maps to reporting-api.json endpoint GET /files/{reportFileId}/data.
 */
class SmartRecruitersReportingDownloadReportFile extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_reporting_download_report_file";
    protected const DESCRIPTION = "Download report file\n\nOfficial SmartRecruiters endpoint: GET /files/{reportFileId}/data from reporting-api.json.";
    protected const PARAMETERS = [
        "report_file_id" => [
            "type" => "string",
            "required" => true,
            "description" => "Report file identifier",
        ],
    ];
    protected const METHOD = "GET";
    protected const BASE_URL = "https://api.smartrecruiters.com/reporting-api/v201804";
    protected const PATH = "/files/{reportFileId}/data";
    protected const PATH_PARAMS = [
        "reportFileId" => "report_file_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
