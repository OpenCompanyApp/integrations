<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Delete a custom integration.
 *
 * Maps to the official LangSmith endpoint DELETE /v1/fleet/integrations/{id}.
 */
class LangSmithDeleteV1FleetIntegrationsId extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_delete_v1_fleet_integrations_id';
    protected const DESCRIPTION = 'Delete a custom integration

Official endpoint: DELETE /v1/fleet/integrations/{id}
Idempotent. Returns 204 whether or not the integration existed.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id`.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/fleet/integrations/{id}';
    protected const PATH_PARAMS = array (
  0 => 'id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
