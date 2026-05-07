<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Get Bulk Export Destination.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/bulk-exports/destinations/{destination_id}.
 */
class LangSmithGetBulkExportDestination extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_bulk_export_destination';
    protected const DESCRIPTION = 'Get Bulk Export Destination

Official endpoint: GET /api/v1/bulk-exports/destinations/{destination_id}
Get a single bulk export destination by ID';
    protected const PARAMETERS = array (
  'destination_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `destination_id`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/bulk-exports/destinations/{destination_id}';
    protected const PATH_PARAMS = array (
  0 => 'destination_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
