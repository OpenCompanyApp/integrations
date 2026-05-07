<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Generate a Plaid-hosted onboarding UI URL..
 *
 * Maps to the official Plaid endpoint post /transfer/questionnaire/create.
 */
class PlaidTransferQuestionnaireCreate extends AbstractPlaidTool
{
    protected const NAME = 'plaid_transfer_questionnaire_create';
    protected const DESCRIPTION = 'Generate a Plaid-hosted onboarding UI URL.

Official Plaid endpoint: POST /transfer/questionnaire/create

The `/transfer/questionnaire/create` endpoint generates a Plaid-hosted onboarding UI URL. Redirect the originator to this URL to provide their due diligence information and agree to Plaid’s terms for ACH money movement.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/transfer/questionnaire/create';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}