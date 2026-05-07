<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Update Current User.
 *
 * Maps to the official LangSmith endpoint PATCH /api/v1/orgs/members/basic.
 */
class LangSmithUpdateCurrentUser extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_update_current_user';
    protected const DESCRIPTION = 'Update Current User

Official endpoint: PATCH /api/v1/orgs/members/basic
Update a user\'s full_name/password (basic auth only)';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'PATCH';
    protected const PATH = '/api/v1/orgs/members/basic';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
