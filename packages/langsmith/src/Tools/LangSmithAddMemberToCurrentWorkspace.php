<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Add Member To Current Workspace.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/workspaces/current/members.
 */
class LangSmithAddMemberToCurrentWorkspace extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_add_member_to_current_workspace';
    protected const DESCRIPTION = 'Add Member To Current Workspace

Official endpoint: POST /api/v1/workspaces/current/members
Add an existing organization member to the current workspace.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/workspaces/current/members';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
