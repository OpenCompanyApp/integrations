<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Generate ad-hoc report.
 *
 * Maps to reporting-api.json endpoint POST /reports/{reportId}/files.
 */
class SmartRecruitersReportingGenerateAdHocReport extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_reporting_generate_ad_hoc_report";
    protected const DESCRIPTION = "Generate ad-hoc report\n\nOfficial SmartRecruiters endpoint: POST /reports/{reportId}/files from reporting-api.json.";
    protected const PARAMETERS = [
        "report_id" => [
            "type" => "string",
            "required" => true,
            "description" => "Report identifier",
        ],
    ];
    protected const METHOD = "POST";
    protected const BASE_URL = "https://api.smartrecruiters.com/reporting-api/v201804";
    protected const PATH = "/reports/{reportId}/files";
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
