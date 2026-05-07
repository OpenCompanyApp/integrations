<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Retrieves all assessment orders for specified application.
 *
 * Maps to assessments-api.json endpoint GET /assessment-orders.
 */
class SmartRecruitersAssessmentsOrdersGetList extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_assessments_orders_get_list";
    protected const DESCRIPTION = "Retrieves all assessment orders for specified application\n\nOfficial SmartRecruiters endpoint: GET /assessment-orders from assessments-api.json.";
    protected const PARAMETERS = [
        "application_id" => [
            "type" => "string",
            "required" => true,
            "description" => "ID of the application",
        ],
    ];
    protected const METHOD = "GET";
    protected const BASE_URL = "https://api.smartrecruiters.com/assessment-api/v202107";
    protected const PATH = "/assessment-orders";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        "applicationId" => "application_id",
    ];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
