<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Cancels self schedule.
 *
 * Maps to self-scheduling.json endpoint DELETE /self-schedules/{id}.
 */
class SmartRecruitersSelfSchedulingCancelSelfSchedule extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_self_scheduling_cancel_self_schedule";
    protected const DESCRIPTION = "Cancels self schedule\n\nOfficial SmartRecruiters endpoint: DELETE /self-schedules/{id} from self-scheduling.json.";
    protected const PARAMETERS = [
        "id" => [
            "type" => "string",
            "required" => true,
            "description" => "path parameter `id`.",
        ],
    ];
    protected const METHOD = "DELETE";
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
