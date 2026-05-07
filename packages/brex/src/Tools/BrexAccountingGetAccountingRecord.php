<?php

namespace OpenCompany\Integrations\Brex\Tools;

/**
 * Get accounting record by ID.
 *
 * Maps to the official Brex endpoint get /v3/accounting/records/{record_id}.
 */
class BrexAccountingGetAccountingRecord extends AbstractBrexTool
{
    protected const NAME = 'brex_accounting_get_accounting_record';
    protected const DESCRIPTION = 'Get accounting record by ID

Official Brex endpoint: GET /v3/accounting/records/{record_id}

Retrieve a single accounting record by its unique identifier';
    protected const PARAMETERS = array (
  'record_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `record_id` from the official Brex API operation.',
  ),
  'single_entry' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Query parameter `single_entry` from the official Brex API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v3/accounting/records/{record_id}';
    protected const PATH_PARAMS = array (
  'record_id' => 'record_id',
);
    protected const QUERY_PARAMS = array (
  'single_entry' => 'single_entry',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
