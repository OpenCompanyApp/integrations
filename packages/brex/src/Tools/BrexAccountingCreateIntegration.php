<?php

namespace OpenCompany\Integrations\Brex\Tools;

/**
 * Create accounting integration.
 *
 * Maps to the official Brex endpoint post /v3/accounting/integration.
 */
class BrexAccountingCreateIntegration extends AbstractBrexTool
{
    protected const NAME = 'brex_accounting_create_integration';
    protected const DESCRIPTION = 'Create accounting integration

Official Brex endpoint: POST /v3/accounting/integration

Create a new accounting integration. The behavior depends on the existing active integration: - If no active integration exists: Creates and returns new integration - If active integration exists with same vendor and vendor_account_id: Returns the existing active integration - If active integration exists with same vendor but different vendor_account_id: Returns 409 error - If active integration exists with different vendor: Returns 409 error This ensures only one active integration exists per account.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Brex OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v3/accounting/integration';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}
