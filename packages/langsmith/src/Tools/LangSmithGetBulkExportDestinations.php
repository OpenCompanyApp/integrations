<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Get Bulk Export Destinations.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/bulk-exports/destinations.
 */
class LangSmithGetBulkExportDestinations extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_bulk_export_destinations';
    protected const DESCRIPTION = 'Get Bulk Export Destinations

Official endpoint: GET /api/v1/bulk-exports/destinations
Get the current workspace\'s bulk export destinations';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/bulk-exports/destinations';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
