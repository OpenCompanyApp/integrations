<?php

namespace OpenCompany\Integrations\GoogleBigQuery\Tools;

/**
 * Row Access Policies Get Iam Policy.
 *
 * Maps to the official BigQuery endpoint POST /{+resource}:getIamPolicy.
 */
class GoogleBigQueryRowAccessPoliciesGetIamPolicy extends AbstractGoogleBigQueryTool
{
    protected const NAME = 'google_bigquery_row_access_policies_get_iam_policy';
    protected const DESCRIPTION = 'Row Access Policies Get Iam Policy

Official BigQuery endpoint: POST /{+resource}:getIamPolicy
Gets the access control policy for a resource. Returns an empty policy if the resource exists and does not have a policy set.';
    protected const PARAMETERS = array (
  'resource' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `resource`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official BigQuery `GetIamPolicyRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/{+resource}:getIamPolicy';
    protected const PATH_PARAMS = array (
  0 => 'resource',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'resource',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}
