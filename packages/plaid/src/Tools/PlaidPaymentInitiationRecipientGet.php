<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Get payment recipient.
 *
 * Maps to the official Plaid endpoint post /payment_initiation/recipient/get.
 */
class PlaidPaymentInitiationRecipientGet extends AbstractPlaidTool
{
    protected const NAME = 'plaid_payment_initiation_recipient_get';
    protected const DESCRIPTION = 'Get payment recipient

Official Plaid endpoint: POST /payment_initiation/recipient/get

Get details about a payment recipient you have previously created.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/payment_initiation/recipient/get';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}