<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Add Basic Auth Members To Current Org.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/orgs/current/members/basic/batch.
 */
class LangSmithAddBasicAuthMembersToCurrentOrg extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_add_basic_auth_members_to_current_org';
    protected const DESCRIPTION = 'Add Basic Auth Members To Current Org

Official endpoint: POST /api/v1/orgs/current/members/basic/batch
Batch add up to 500 users to the org and specified workspaces in basic auth mode.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/orgs/current/members/basic/batch';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
