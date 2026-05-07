<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * (Deprecated) Check digital income verification eligibility and optimize conversion.
 *
 * Maps to the official Plaid endpoint post /income/verification/precheck.
 */
class PlaidIncomeVerificationPrecheck extends AbstractPlaidTool
{
    protected const NAME = 'plaid_income_verification_precheck';
    protected const DESCRIPTION = '(Deprecated) Check digital income verification eligibility and optimize conversion

Official Plaid endpoint: POST /income/verification/precheck

`/income/verification/precheck` is an optional endpoint that can be called before initializing a Link session for income verification. It evaluates whether a given user is supportable by digital income verification and returns a `precheck_id` that can be provided to `/link/token/create`. If the user is eligible for digital verification, providing the `precheck_id` in this way will generate a Link UI optimized for the end user and their specific employer. If the user cannot be confirmed as eligible, the `precheck_id` can still be provided to `/link/token/create` and the user can still use the income verification flow, but they may be required to manually upload a paystub to verify their in...';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/income/verification/precheck';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}