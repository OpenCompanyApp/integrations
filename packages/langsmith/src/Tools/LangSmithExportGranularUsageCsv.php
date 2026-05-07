<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Export Granular Usage Csv.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/orgs/current/billing/granular-usage/export.
 */
class LangSmithExportGranularUsageCsv extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_export_granular_usage_csv';
    protected const DESCRIPTION = 'Export Granular Usage Csv

Official endpoint: GET /api/v1/orgs/current/billing/granular-usage/export
Export granular usage data as CSV. Returns the same data as the granular-usage endpoint but formatted as a downloadable CSV file. Only workspaces the user has read access to will be included in the results.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters. Known keys: start_time, end_time, workspace_ids, group_by.',
  ),
  'start_time' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `start_time`.',
  ),
  'end_time' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `end_time`.',
  ),
  'workspace_ids' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `workspace_ids`.',
  ),
  'group_by' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `group_by`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/orgs/current/billing/granular-usage/export';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'start_time',
  1 => 'end_time',
  2 => 'workspace_ids',
  3 => 'group_by',
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
