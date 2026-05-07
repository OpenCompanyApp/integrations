<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Returns details for a single New Hire.
 *
 * Maps to smartonboard.json endpoint GET /new-hires/{newHireId}.
 */
class SmartRecruitersSmartonboardNewHiresGet extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_smartonboard_new_hires_get";
    protected const DESCRIPTION = "Returns details for a single New Hire\n\nOfficial SmartRecruiters endpoint: GET /new-hires/{newHireId} from smartonboard.json.";
    protected const PARAMETERS = [
        "new_hire_id" => [
            "type" => "string",
            "required" => true,
            "description" => "ID of the New Hire",
        ],
    ];
    protected const METHOD = "GET";
    protected const BASE_URL = "https://api.smartrecruiters.com/smartonboard-api/v202205";
    protected const PATH = "/new-hires/{newHireId}";
    protected const PATH_PARAMS = [
        "newHireId" => "new_hire_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
