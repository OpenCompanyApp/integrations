<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Supervisoragents Update Permissions.
 *
 * Maps to the official Databricks SDK endpoint patch /api/2.0/permissions/supervisor-agents/{supervisor_agent_id}.
 */
class DatabricksSupervisoragentsUpdatePermissions extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_supervisoragents_update_permissions';
    protected const DESCRIPTION = 'Supervisoragents Update Permissions

Official Databricks SDK endpoint: PATCH /api/2.0/permissions/supervisor-agents/{supervisor_agent_id}

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
  'supervisor_agent_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `supervisor_agent_id` from the Databricks SDK endpoint.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'description' => 'Optional query string parameters matching the Databricks REST API request fields.',
  ),
  'headers' =>
  array (
    'type' => 'object',
    'description' => 'Optional additional request headers for advanced Databricks endpoints.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'Optional JSON request body matching the Databricks REST API request fields.',
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/api/2.0/permissions/supervisor-agents/{supervisor_agent_id}';
    protected const PATH_PARAMS = array (
  'supervisor_agent_id' => 'supervisor_agent_id',
);
}
