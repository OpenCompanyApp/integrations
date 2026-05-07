<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * Retrieve a dashboard user.
 *
 * Maps to the official Plaid endpoint post /dashboard_user/get.
 */
class PlaidDashboardUserGet extends AbstractPlaidTool
{
    protected const NAME = 'plaid_dashboard_user_get';
    protected const DESCRIPTION = 'Retrieve a dashboard user

Official Plaid endpoint: POST /dashboard_user/get

The `/dashboard_user/get` endpoint provides details (such as email address) about a specific Dashboard user based on the `dashboard_user_id` field, which is returned in the `audit_trail` object of certain Monitor and Beacon endpoints. This can be used to identify the specific reviewer who performed a Dashboard action.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/dashboard_user/get';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}