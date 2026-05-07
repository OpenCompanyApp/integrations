<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Submit transfer diligence on behalf of the originator.
 *
 * Maps to the official Plaid endpoint post /transfer/diligence/submit.
 */
class PlaidTransferDiligenceSubmit extends AbstractPlaidTool
{
    protected const NAME = 'plaid_transfer_diligence_submit';
    protected const DESCRIPTION = 'Submit transfer diligence on behalf of the originator

Official Plaid endpoint: POST /transfer/diligence/submit

Use the `/transfer/diligence/submit` endpoint to submit transfer diligence on behalf of the originator (i.e., the end customer).';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/transfer/diligence/submit';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}