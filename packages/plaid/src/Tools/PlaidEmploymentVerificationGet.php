<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * (Deprecated) Retrieve a summary of an individual's employment information.
 *
 * Maps to the official Plaid endpoint post /employment/verification/get.
 */
class PlaidEmploymentVerificationGet extends AbstractPlaidTool
{
    protected const NAME = 'plaid_employment_verification_get';
    protected const DESCRIPTION = '(Deprecated) Retrieve a summary of an individual\'s employment information

Official Plaid endpoint: POST /employment/verification/get

`/employment/verification/get` returns a list of employments through a user payroll that was verified by an end user. This endpoint has been deprecated; new integrations should use `/credit/employment/get` instead.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/employment/verification/get';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}