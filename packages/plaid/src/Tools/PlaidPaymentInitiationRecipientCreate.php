<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Create payment recipient.
 *
 * Maps to the official Plaid endpoint post /payment_initiation/recipient/create.
 */
class PlaidPaymentInitiationRecipientCreate extends AbstractPlaidTool
{
    protected const NAME = 'plaid_payment_initiation_recipient_create';
    protected const DESCRIPTION = 'Create payment recipient

Official Plaid endpoint: POST /payment_initiation/recipient/create

Create a payment recipient for payment initiation. The recipient must be in Europe, within a country that is a member of the Single Euro Payment Area (SEPA) or a non-Eurozone country [supported](https://plaid.com/global) by Plaid. For a standing order (recurring) payment, the recipient must be in the UK. It is recommended to use `bacs` in the UK and `iban` in EU. The endpoint is idempotent: if a developer has already made a request with the same payment details, Plaid will return the same `recipient_id`.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/payment_initiation/recipient/create';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}