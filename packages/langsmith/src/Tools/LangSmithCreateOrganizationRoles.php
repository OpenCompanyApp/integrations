<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Create Organization Roles.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/orgs/current/roles.
 */
class LangSmithCreateOrganizationRoles extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_create_organization_roles';
    protected const DESCRIPTION = 'Create Organization Roles

Official endpoint: POST /api/v1/orgs/current/roles
Create Organization Roles.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/orgs/current/roles';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
