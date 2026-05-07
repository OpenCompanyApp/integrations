<?php

namespace OpenCompany\Integrations\Plaid\Tools;

/**
 * List dashboard users.
 *
 * Maps to the official Plaid endpoint post /dashboard_user/list.
 */
class PlaidDashboardUserList extends AbstractPlaidTool
{
    protected const NAME = 'plaid_dashboard_user_list';
    protected const DESCRIPTION = 'List dashboard users

Official Plaid endpoint: POST /dashboard_user/list

The `/dashboard_user/list` endpoint provides details (such as email address) all Dashboard users associated with your account. This can use used to audit or track the list of reviewers for Monitor, Beacon, and Identity Verification products.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Plaid OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/dashboard_user/list';
    protected const PATH_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}