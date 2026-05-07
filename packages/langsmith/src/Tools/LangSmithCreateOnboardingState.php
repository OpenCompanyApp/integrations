<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Create Onboarding State.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/me/onboarding_state.
 */
class LangSmithCreateOnboardingState extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_create_onboarding_state';
    protected const DESCRIPTION = 'Create Onboarding State

Official endpoint: POST /api/v1/me/onboarding_state
Initialize onboarding state for the current user.';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/me/onboarding_state';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
