<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Get Bulk Export Runs Filtered.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/bulk-exports/runs.
 */
class LangSmithGetBulkExportRunsFiltered extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_bulk_export_runs_filtered';
    protected const DESCRIPTION = 'Get Bulk Export Runs Filtered

Official endpoint: GET /api/v1/bulk-exports/runs
Get all bulk export runs for exports that were created from a scheduled bulk export';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters. Known keys: source_bulk_export_id.',
  ),
  'source_bulk_export_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `source_bulk_export_id`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/bulk-exports/runs';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'source_bulk_export_id',
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
