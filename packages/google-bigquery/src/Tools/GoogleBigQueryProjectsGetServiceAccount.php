<?php

namespace OpenCompany\Integrations\GoogleBigQuery\Tools;

/**
 * Projects Get Service Account.
 *
 * Maps to the official BigQuery endpoint GET /projects/{+projectId}/serviceAccount.
 */
class GoogleBigQueryProjectsGetServiceAccount extends AbstractGoogleBigQueryTool
{
    protected const NAME = 'google_bigquery_projects_get_service_account';
    protected const DESCRIPTION = 'Projects Get Service Account

Official BigQuery endpoint: GET /projects/{+projectId}/serviceAccount
RPC to get the service account for a project used for interactions with Google Cloud KMS';
    protected const PARAMETERS = array (
  'projectId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `projectId`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/projects/{+projectId}/serviceAccount';
    protected const PATH_PARAMS = array (
  0 => 'projectId',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'projectId',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
}
