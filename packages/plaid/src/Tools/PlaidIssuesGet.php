<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Get an Issue.
 *
 * Maps to the official Plaid endpoint post /issues/get.
 */
class PlaidIssuesGet extends AbstractPlaidTool
{
    protected const NAME = 'plaid_issues_get';
    protected const DESCRIPTION = 'Get an Issue

Official Plaid endpoint: POST /issues/get

Retrieve detailed information about a specific `Issue`. This endpoint returns a single `Issue` object.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/issues/get';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}