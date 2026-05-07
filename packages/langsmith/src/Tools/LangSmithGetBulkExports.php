<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Get Bulk Exports.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/bulk-exports.
 */
class LangSmithGetBulkExports extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_bulk_exports';
    protected const DESCRIPTION = 'Get Bulk Exports

Official endpoint: GET /api/v1/bulk-exports
Get the current workspace\'s bulk exports';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/bulk-exports';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}
