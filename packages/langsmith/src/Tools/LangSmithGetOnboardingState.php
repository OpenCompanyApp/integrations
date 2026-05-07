<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Get Onboarding State.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/me/onboarding_state.
 */
class LangSmithGetOnboardingState extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_onboarding_state';
    protected const DESCRIPTION = 'Get Onboarding State

Official endpoint: GET /api/v1/me/onboarding_state
Get onboarding state for the current user.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/me/onboarding_state';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
