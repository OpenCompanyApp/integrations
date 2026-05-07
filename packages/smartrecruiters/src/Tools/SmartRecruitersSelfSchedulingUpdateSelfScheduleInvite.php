<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Requests invite update for automated self-schedule.
 *
 * Maps to self-scheduling.json endpoint POST /automated-self-schedules/update-invite.
 */
class SmartRecruitersSelfSchedulingUpdateSelfScheduleInvite extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_self_scheduling_update_self_schedule_invite";
    protected const DESCRIPTION = "Requests invite update for automated self-schedule\n\nOfficial SmartRecruiters endpoint: POST /automated-self-schedules/update-invite from self-scheduling.json.";
    protected const PARAMETERS = [
        "body" => [
            "type" => "object",
            "required" => true,
            "description" => "Request body matching the official SmartRecruiters self-scheduling.json schema for Requests invite update for automated self-schedule.",
        ],
    ];
    protected const METHOD = "POST";
    protected const BASE_URL = "https://api.smartrecruiters.com/self-scheduling";
    protected const PATH = "/automated-self-schedules/update-invite";
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
