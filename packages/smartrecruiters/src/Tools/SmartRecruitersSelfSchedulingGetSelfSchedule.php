<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Gets self schedule by id.
 *
 * Maps to self-scheduling.json endpoint GET /self-schedules/{id}.
 */
class SmartRecruitersSelfSchedulingGetSelfSchedule extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_self_scheduling_get_self_schedule";
    protected const DESCRIPTION = "Gets self schedule by id\n\nOfficial SmartRecruiters endpoint: GET /self-schedules/{id} from self-scheduling.json.";
    protected const PARAMETERS = [
        "id" => [
            "type" => "string",
            "required" => true,
            "description" => "path parameter `id`.",
        ],
    ];
    protected const METHOD = "GET";
    protected const BASE_URL = "https://api.smartrecruiters.com/self-scheduling";
    protected const PATH = "/self-schedules/{id}";
    protected const PATH_PARAMS = [
        "id" => "id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
