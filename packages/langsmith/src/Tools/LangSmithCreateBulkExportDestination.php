<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Create Bulk Export Destination.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/bulk-exports/destinations.
 */
class LangSmithCreateBulkExportDestination extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_create_bulk_export_destination';
    protected const DESCRIPTION = 'Create Bulk Export Destination

Official endpoint: POST /api/v1/bulk-exports/destinations
Create a new bulk export destination';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/bulk-exports/destinations';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}
