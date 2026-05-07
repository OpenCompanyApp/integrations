<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * request closure of internal account.
 *
 * Maps to the official Modern Treasury endpoint post /api/internal_accounts/{id}/request_closure.
 */
class ModernTreasuryRequestInternalAccountClosure extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_request_internal_account_closure';
    protected const DESCRIPTION = 'request closure of internal account

Official Modern Treasury endpoint: POST /api/internal_accounts/{id}/request_closure';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official Modern Treasury API operation.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Modern Treasury OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/internal_accounts/{id}/request_closure';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
