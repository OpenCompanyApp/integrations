<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Update an agent.
 *
 * Maps to the official LangSmith endpoint PATCH /v1/fleet/agents/{agentID}.
 */
class LangSmithPatchV1FleetAgentsAgentid extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_patch_v1_fleet_agents_agentid';
    protected const DESCRIPTION = 'Update an agent

Official endpoint: PATCH /v1/fleet/agents/{agentID}
Updates the specified agent. All request fields are optional; omitted fields are left unchanged. When a top-level field is provided, it replaces the existing value in full. Entries under `files` are created or replaced by path; paths listed in `deleted_paths` are removed. The call is atomic: if any entry fails validation, no changes are applied. The file tree is omitted from the response by default; pass ?include=...';
    protected const PARAMETERS = array (
  'agentID' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `agentID`.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters. Known keys: include.',
  ),
  'include' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `include`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'PATCH';
    protected const PATH = '/v1/fleet/agents/{agentID}';
    protected const PATH_PARAMS = array (
  0 => 'agentID',
);
    protected const QUERY_KEYS = array (
  0 => 'include',
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
