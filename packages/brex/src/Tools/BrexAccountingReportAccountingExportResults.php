<?php

namespace OpenCompany\Integrations\Brex\Tools;

/**
 * Report accounting export results.
 *
 * Maps to the official Brex endpoint post /v3/accounting/records/export-results.
 */
class BrexAccountingReportAccountingExportResults extends AbstractBrexTool
{
    protected const NAME = 'brex_accounting_report_accounting_export_results';
    protected const DESCRIPTION = 'Report accounting export results

Official Brex endpoint: POST /v3/accounting/records/export-results

Report export success or failure for accounting records.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Brex OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v3/accounting/records/export-results';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
