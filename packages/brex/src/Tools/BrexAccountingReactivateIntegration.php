<?php

namespace OpenCompany\Integrations\Brex\Tools;

/**
 * Reactivate accounting integration.
 *
 * Maps to the official Brex endpoint post /v3/accounting/integration/{integration_id}/reactivate.
 */
class BrexAccountingReactivateIntegration extends AbstractBrexTool
{
    protected const NAME = 'brex_accounting_reactivate_integration';
    protected const DESCRIPTION = 'Reactivate accounting integration

Official Brex endpoint: POST /v3/accounting/integration/{integration_id}/reactivate

Reactivate a disconnected accounting integration. - If integration is DISABLED: Reactivates and returns success - If integration ID doesn\'t exist: Returns 404 error - If an active integration already exists: Returns 409 error';
    protected const PARAMETERS = array (
  'integration_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `integration_id` from the official Brex API operation.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Brex OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v3/accounting/integration/{integration_id}/reactivate';
    protected const PATH_PARAMS = array (
  'integration_id' => 'integration_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
