<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Returns details of a single Onboarding Process.
 *
 * Maps to smartonboard.json endpoint GET /onboarding-processes/{onboardingProcessId}.
 */
class SmartRecruitersSmartonboardOnboardingProcessesGet extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_smartonboard_onboarding_processes_get";
    protected const DESCRIPTION = "Returns details of a single Onboarding Process\n\nOfficial SmartRecruiters endpoint: GET /onboarding-processes/{onboardingProcessId} from smartonboard.json.";
    protected const PARAMETERS = [
        "onboarding_process_id" => [
            "type" => "string",
            "required" => true,
            "description" => "ID of the Onboarding Process",
        ],
    ];
    protected const METHOD = "GET";
    protected const BASE_URL = "https://api.smartrecruiters.com/smartonboard-api/v202205";
    protected const PATH = "/onboarding-processes/{onboardingProcessId}";
    protected const PATH_PARAMS = [
        "onboardingProcessId" => "onboarding_process_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
