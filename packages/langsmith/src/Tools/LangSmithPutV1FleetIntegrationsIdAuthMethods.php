<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Replace integration auth methods.
 *
 * Maps to the official LangSmith endpoint PUT /v1/fleet/integrations/{id}/auth-methods.
 */
class LangSmithPutV1FleetIntegrationsIdAuthMethods extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_put_v1_fleet_integrations_id_auth_methods';
    protected const DESCRIPTION = 'Replace integration auth methods

Official endpoint: PUT /v1/fleet/integrations/{id}/auth-methods
Replaces the integration\'s full list of supported auth methods.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'PUT';
    protected const PATH = '/v1/fleet/integrations/{id}/auth-methods';
    protected const PATH_PARAMS = array (
  0 => 'id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
