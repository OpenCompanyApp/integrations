<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Get Bulk Export.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/bulk-exports/{bulk_export_id}.
 */
class LangSmithGetBulkExport extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_bulk_export';
    protected const DESCRIPTION = 'Get Bulk Export

Official endpoint: GET /api/v1/bulk-exports/{bulk_export_id}
Get a single bulk export by ID';
    protected const PARAMETERS = array (
  'bulk_export_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `bulk_export_id`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/bulk-exports/{bulk_export_id}';
    protected const PATH_PARAMS = array (
  0 => 'bulk_export_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
