<?php

namespace OpenCompany\Integrations\SmartRecruiters\Tools;

/**
 * Returns Assignments associated with a single Onboarding Process.
 *
 * Maps to smartonboard.json endpoint GET /onboarding-processes/{onboardingProcessId}/assignments.
 */
class SmartRecruitersSmartonboardOnboardingProcessesAssignmentsGet extends AbstractSmartRecruitersTool
{
    protected const NAME = "smartrecruiters_smartonboard_onboarding_processes_assignments_get";
    protected const DESCRIPTION = "Returns Assignments associated with a single Onboarding Process\n\nOfficial SmartRecruiters endpoint: GET /onboarding-processes/{onboardingProcessId}/assignments from smartonboard.json.";
    protected const PARAMETERS = [
        "onboarding_process_id" => [
            "type" => "string",
            "required" => true,
            "description" => "ID of the Onboarding Process",
        ],
        "integration_relevant" => [
            "type" => "boolean",
            "required" => false,
            "description" => "Indicate if only assignments that have integration key defined should be fetched. By default set to false",
        ],
    ];
    protected const METHOD = "GET";
    protected const BASE_URL = "https://api.smartrecruiters.com/smartonboard-api/v202205";
    protected const PATH = "/onboarding-processes/{onboardingProcessId}/assignments";
    protected const PATH_PARAMS = [
        "onboardingProcessId" => "onboarding_process_id",
    ];
    protected const QUERY_PARAMS = [
        "integrationRelevant" => "integration_relevant",
    ];
    protected const HEADER_PARAMS = [];
    protected const QUERY_STYLES = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = "json";
    protected const AUTH_MODE = "either";
}
