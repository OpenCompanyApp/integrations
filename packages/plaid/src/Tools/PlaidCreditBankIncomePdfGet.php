<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Retrieve information from the bank accounts used for income verification in PDF format.
 *
 * Maps to the official Plaid endpoint post /credit/bank_income/pdf/get.
 */
class PlaidCreditBankIncomePdfGet extends AbstractPlaidTool
{
    protected const NAME = 'plaid_credit_bank_income_pdf_get';
    protected const DESCRIPTION = 'Retrieve information from the bank accounts used for income verification in PDF format

Official Plaid endpoint: POST /credit/bank_income/pdf/get

`/credit/bank_income/pdf/get` returns the most recent bank income report for a specified user in PDF format. A single report corresponds to all institutions linked in a single Link session. To include multiple institutions in a single report, use [Multi-Item Link](https://plaid.com/docs/link/multi-item-link).

This endpoint can return binary content such as PDF data. Non-JSON responses are returned as `{body, status}`.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/credit/bank_income/pdf/get';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}