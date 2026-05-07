<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Create an access policy.
 *
 * Maps to the official LangSmith endpoint POST /v1/platform/orgs/current/access-policies.
 */
class LangSmithPostV1PlatformOrgsCurrentAccessPolicies extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_post_v1_platform_orgs_current_access_policies';
    protected const DESCRIPTION = 'Create an access policy

Official endpoint: POST /v1/platform/orgs/current/access-policies
Creates a new access policy.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/platform/orgs/current/access-policies';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
