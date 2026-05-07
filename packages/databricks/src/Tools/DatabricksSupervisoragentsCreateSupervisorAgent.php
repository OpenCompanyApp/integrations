<?php

namespace OpenCompany\Integrations\Databricks\Tools;

/**
 * Supervisoragents Create Supervisor Agent.
 *
 * Maps to the official Databricks SDK endpoint post /api/2.1/supervisor-agents.
 */
class DatabricksSupervisoragentsCreateSupervisorAgent extends AbstractDatabricksTool
{
    protected const NAME = 'databricks_supervisoragents_create_supervisor_agent';
    protected const DESCRIPTION = 'Supervisoragents Create Supervisor Agent

Official Databricks SDK endpoint: POST /api/2.1/supervisor-agents

Generated from the official databricks-sdk-go surface, which is generated from Databricks OpenAPI specs.';
    protected const PARAMETERS = array (
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
    protected const METHOD = 'post';
    protected const PATH = '/api/2.1/supervisor-agents';
    protected const PATH_PARAMS = array (
);
}
