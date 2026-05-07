<?php

namespace OpenCompany\Integrations\MicrosoftPrint\Tools;

/**
 * Get documents from print.
 *
 * Maps to Microsoft Graph v1.0 endpoint GET /print/shares/{printerShare-id}/jobs/{printJob-id}/documents/{printDocument-id}.
 */
class MicrosoftPrintPrintSharesJobsGetDocuments extends AbstractMicrosoftPrintTool
{
    protected const NAME = 'microsoft_print_print_shares_jobs_get_documents';
    protected const DESCRIPTION = 'Get documents from print\\n\\nOfficial Microsoft Graph v1.0 endpoint: GET /print/shares/{printerShare-id}/jobs/{printJob-id}/documents/{printDocument-id}.';
    protected const PARAMETERS = ['printer_share_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `printerShare-id`.'], 'print_job_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `printJob-id`.'], 'print_document_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `printDocument-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'if_match' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `If-Match` header for conditional updates or deletes.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `ConsistencyLevel` header, usually `eventual` for advanced queries.']];
    protected const METHOD = 'GET';
    protected const PATH = '/print/shares/{printerShare-id}/jobs/{printJob-id}/documents/{printDocument-id}';
    protected const PATH_PARAMS = ['printerShare-id' => 'printer_share_id', 'printJob-id' => 'print_job_id', 'printDocument-id' => 'print_document_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
}
