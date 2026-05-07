<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * List payment recipients.
 *
 * Maps to the official Plaid endpoint post /payment_initiation/recipient/list.
 */
class PlaidPaymentInitiationRecipientList extends AbstractPlaidTool
{
    protected const NAME = 'plaid_payment_initiation_recipient_list';
    protected const DESCRIPTION = 'List payment recipients

Official Plaid endpoint: POST /payment_initiation/recipient/list

The `/payment_initiation/recipient/list` endpoint list the payment recipients that you have previously created.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/payment_initiation/recipient/list';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}