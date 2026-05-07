<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Subscribe to an Issue.
 *
 * Maps to the official Plaid endpoint post /issues/subscribe.
 */
class PlaidIssuesSubscribe extends AbstractPlaidTool
{
    protected const NAME = 'plaid_issues_subscribe';
    protected const DESCRIPTION = 'Subscribe to an Issue

Official Plaid endpoint: POST /issues/subscribe

Allows a user to subscribe to updates on a specific `Issue` using a POST method. Subscribers will receive webhook notifications when the issue status changes, particularly when resolved.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/issues/subscribe';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}