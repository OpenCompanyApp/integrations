<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Update Current Organization Info.
 *
 * Maps to the official LangSmith endpoint PATCH /api/v1/orgs/current/info.
 */
class LangSmithUpdateCurrentOrganizationInfo extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_update_current_organization_info';
    protected const DESCRIPTION = 'Update Current Organization Info

Official endpoint: PATCH /api/v1/orgs/current/info
Update Current Organization Info.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'PATCH';
    protected const PATH = '/api/v1/orgs/current/info';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
