<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Get report.
 *
 * Maps to reporting-api.json endpoint GET /reports/{reportId}.
 */
class SmartRecruitersReportingGetReport extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_reporting_get_report";
    protected const DESCRIPTION = "Get report\n\nOfficial SmartRecruiters endpoint: GET /reports/{reportId} from reporting-api.json.";
    protected const PARAMETERS = [
        "report_id" => [
            "type" => "string",
            "required" => true,
            "description" => "Report identifier",
        ],
    ];
    protected const METHOD = "GET";
    protected const BASE_URL = "https://api.smartrecruiters.com/reporting-api/v201804";
    protected const PATH = "/reports/{reportId}";
    protected const PATH_PARAMS = [
        "reportId" => "report_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
