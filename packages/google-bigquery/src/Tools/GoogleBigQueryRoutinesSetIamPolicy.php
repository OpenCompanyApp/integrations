<?php

namespace OpenCompany\Integrations\GoogleBigQuery\Tools;

/**
 * Routines Set Iam Policy.
 *
 * Maps to the official BigQuery endpoint POST /{+resource}:setIamPolicy.
 */
class GoogleBigQueryRoutinesSetIamPolicy extends AbstractGoogleBigQueryTool
{
    protected const NAME = 'google_bigquery_routines_set_iam_policy';
    protected const DESCRIPTION = 'Routines Set Iam Policy

Official BigQuery endpoint: POST /{+resource}:setIamPolicy
Sets the access control policy on the specified resource. Replaces any existing policy. Can return `NOT_FOUND`, `INVALID_ARGUMENT`, and `PERMISSION_DENIED` errors.';
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
    'description' => 'JSON request body matching the official BigQuery `SetIamPolicyRequest` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/{+resource}:setIamPolicy';
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
