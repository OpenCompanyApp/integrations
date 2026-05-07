<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Update Bulk Export Destination.
 *
 * Maps to the official LangSmith endpoint PATCH /api/v1/bulk-exports/destinations/{destination_id}.
 */
class LangSmithUpdateBulkExportDestination extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_update_bulk_export_destination';
    protected const DESCRIPTION = 'Update Bulk Export Destination

Official endpoint: PATCH /api/v1/bulk-exports/destinations/{destination_id}
Update a bulk export destination';
    protected const PARAMETERS = array (
  'destination_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `destination_id`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'PATCH';
    protected const PATH = '/api/v1/bulk-exports/destinations/{destination_id}';
    protected const PATH_PARAMS = array (
  0 => 'destination_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
