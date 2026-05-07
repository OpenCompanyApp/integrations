<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Get Bulk Export Runs.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/bulk-exports/{bulk_export_id}/runs.
 */
class LangSmithGetBulkExportRuns extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_bulk_export_runs';
    protected const DESCRIPTION = 'Get Bulk Export Runs

Official endpoint: GET /api/v1/bulk-exports/{bulk_export_id}/runs
Get a bulk export\'s runs';
    protected const PARAMETERS = array (
  'bulk_export_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `bulk_export_id`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/bulk-exports/{bulk_export_id}/runs';
    protected const PATH_PARAMS = array (
  0 => 'bulk_export_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
