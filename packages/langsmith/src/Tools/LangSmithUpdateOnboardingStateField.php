<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Update Onboarding State Field.
 *
 * Maps to the official LangSmith endpoint PUT /api/v1/me/onboarding_state/{field}.
 */
class LangSmithUpdateOnboardingStateField extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_update_onboarding_state_field';
    protected const DESCRIPTION = 'Update Onboarding State Field

Official endpoint: PUT /api/v1/me/onboarding_state/{field}
Update a specific onboarding completion field for the current user. Valid fields: - tracing_completed_at - lgstudio_completed_at - playground_completed_at - evaluation_completed_at - success_viewed_at';
    protected const PARAMETERS = array (
  'field' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `field`.',
  ),
);
    protected const METHOD = 'PUT';
    protected const PATH = '/api/v1/me/onboarding_state/{field}';
    protected const PATH_PARAMS = array (
  0 => 'field',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
