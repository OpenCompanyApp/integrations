<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Returns specific Assignment associated with a single Onboarding Process.
 *
 * Maps to smartonboard.json endpoint GET /onboarding-processes/{onboardingProcessId}/assignments/{assignmentId}.
 */
class SmartRecruitersSmartonboardOnboardingProcessesAssignmentGet extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_smartonboard_onboarding_processes_assignment_get";
    protected const DESCRIPTION = "Returns specific Assignment associated with a single Onboarding Process\n\nOfficial SmartRecruiters endpoint: GET /onboarding-processes/{onboardingProcessId}/assignments/{assignmentId} from smartonboard.json.";
    protected const PARAMETERS = [
        "onboarding_process_id" => [
            "type" => "string",
            "required" => true,
            "description" => "ID of the Onboarding Process",
        ],
        "assignment_id" => [
            "type" => "string",
            "required" => true,
            "description" => "ID of the Assignment",
        ],
    ];
    protected const METHOD = "GET";
    protected const BASE_URL = "https://api.smartrecruiters.com/smartonboard-api/v202205";
    protected const PATH = "/onboarding-processes/{onboardingProcessId}/assignments/{assignmentId}";
    protected const PATH_PARAMS = [
        "onboardingProcessId" => "onboarding_process_id",
        "assignmentId" => "assignment_id",
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
