<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Cancel Bulk Export.
 *
 * Maps to the official LangSmith endpoint PATCH /api/v1/bulk-exports/{bulk_export_id}.
 */
class LangSmithCancelBulkExport extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_cancel_bulk_export';
    protected const DESCRIPTION = 'Cancel Bulk Export

Official endpoint: PATCH /api/v1/bulk-exports/{bulk_export_id}
Cancel a bulk export by ID';
    protected const PARAMETERS = array (
  'bulk_export_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `bulk_export_id`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'PATCH';
    protected const PATH = '/api/v1/bulk-exports/{bulk_export_id}';
    protected const PATH_PARAMS = array (
  0 => 'bulk_export_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
