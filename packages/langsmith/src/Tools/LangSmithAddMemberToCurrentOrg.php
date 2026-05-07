<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Add Member To Current Org.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/orgs/current/members.
 */
class LangSmithAddMemberToCurrentOrg extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_add_member_to_current_org';
    protected const DESCRIPTION = 'Add Member To Current Org

Official endpoint: POST /api/v1/orgs/current/members
Add Member To Current Org.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/orgs/current/members';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
