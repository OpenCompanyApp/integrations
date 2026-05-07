<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Get Current Workspace Encrypted Secrets.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/workspaces/current/secrets/encrypted.
 */
class LangSmithGetCurrentWorkspaceEncryptedSecrets extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_current_workspace_encrypted_secrets';
    protected const DESCRIPTION = 'Get Current Workspace Encrypted Secrets

Official endpoint: GET /api/v1/workspaces/current/secrets/encrypted
Get encrypted workspace secrets for use with Fleet and external services.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters. Known keys: service, key_names, expand_iam_role.',
  ),
  'service' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `service`.',
  ),
  'key_names' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `key_names`.',
  ),
  'expand_iam_role' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `expand_iam_role`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/workspaces/current/secrets/encrypted';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'service',
  1 => 'key_names',
  2 => 'expand_iam_role',
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
