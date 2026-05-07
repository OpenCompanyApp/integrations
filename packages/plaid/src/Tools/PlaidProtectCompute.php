<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Compute Protect Trust Index Score.
 *
 * Maps to the official Plaid endpoint post /protect/compute.
 */
class PlaidProtectCompute extends AbstractPlaidTool
{
    protected const NAME = 'plaid_protect_compute';
    protected const DESCRIPTION = 'Compute Protect Trust Index Score

Official Plaid endpoint: POST /protect/compute

Use this endpoint to compute a Protect Trust Index score and retrieve fraud attributes. For link-session models, if the Link session is not yet complete, the endpoint returns HTTP 400 with `error_type` = `INVALID_REQUEST` and `error_code` = `FAILED_PRECONDITION`.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/protect/compute';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}