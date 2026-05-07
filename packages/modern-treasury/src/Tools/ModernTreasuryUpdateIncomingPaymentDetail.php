<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * update incoming payment detail.
 *
 * Maps to the official Modern Treasury endpoint patch /api/incoming_payment_details/{id}.
 */
class ModernTreasuryUpdateIncomingPaymentDetail extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_update_incoming_payment_detail';
    protected const DESCRIPTION = 'update incoming payment detail

Official Modern Treasury endpoint: PATCH /api/incoming_payment_details/{id}

Update an existing Incoming Payment Detail.';
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
    protected const METHOD = 'patch';
    protected const PATH = '/api/incoming_payment_details/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
