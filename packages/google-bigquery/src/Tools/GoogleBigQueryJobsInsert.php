<?php

namespace OpenCompany\Integrations\GoogleBigQuery\Tools;

/**
 * Jobs Insert.
 *
 * Maps to the official BigQuery endpoint POST /projects/{+projectId}/jobs.
 */
class GoogleBigQueryJobsInsert extends AbstractGoogleBigQueryTool
{
    protected const NAME = 'google_bigquery_jobs_insert';
    protected const DESCRIPTION = 'Jobs Insert

Official BigQuery endpoint: POST /projects/{+projectId}/jobs
Starts a new asynchronous job. This API has two different kinds of endpoint URIs, as this method supports a variety of use cases. * The *Metadata* URI is used for most interactions, as it accepts the job configuration directly. * The *Upload* URI is ONLY for the case when you\'re sending both a load job configuration and a data stream together. In this case, the Upload URI accepts the job configuration and the data as two distinct multipart MIME parts.';
    protected const PARAMETERS = array (
  'projectId' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `projectId`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official BigQuery `Job` schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/projects/{+projectId}/jobs';
    protected const PATH_PARAMS = array (
  0 => 'projectId',
);
    protected const RESERVED_PATH_PARAMS = array (
  0 => 'projectId',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
}
