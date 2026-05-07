<?php

namespace OpenCompany\Integrations\ModernTreasury\Tools;

/**
 * get incoming payment detail.
 *
 * Maps to the official Modern Treasury endpoint get /api/incoming_payment_details/{id}.
 */
class ModernTreasuryGetIncomingPaymentDetail extends AbstractModernTreasuryTool
{
    protected const NAME = 'modern_treasury_get_incoming_payment_detail';
    protected const DESCRIPTION = 'get incoming payment detail

Official Modern Treasury endpoint: GET /api/incoming_payment_details/{id}

Get an existing Incoming Payment Detail.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official Modern Treasury API operation.',
  ),
);
    protected const METHOD = 'get';
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
