<?php

namespace OpenCompany\Integrations\Kubernetes\Tools;

/**
 * Read batch v 1 namespaced cron job status.
 *
 * Maps to the official Kubernetes endpoint get /apis/batch/v1/namespaces/{namespace}/cronjobs/{name}/status.
 */
class KubernetesReadBatchV1NamespacedCronJobStatus extends AbstractKubernetesTool
{
    protected const NAME = 'kubernetes_read_batch_v1_namespaced_cron_job_status';
    protected const DESCRIPTION = 'Read batch v 1 namespaced cron job status

Official Kubernetes endpoint: GET /apis/batch/v1/namespaces/{namespace}/cronjobs/{name}/status

read status of the specified CronJob';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'description' => 'name of the CronJob',
    'required' => true,
  ),
  'namespace' =>
  array (
    'type' => 'string',
    'description' => 'object name and auth scope, such as for teams and projects',
    'required' => true,
  ),
  'pretty' =>
  array (
    'type' => 'string',
    'description' => 'If \'true\', then the output is pretty printed. Defaults to \'false\' unless the user-agent indicates a browser or command-line HTTP tool (curl and wget).',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/apis/batch/v1/namespaces/{namespace}/cronjobs/{name}/status';
    protected const PATH_PARAMS = array (
  'name' => 'name',
  'namespace' => 'namespace',
);
    protected const QUERY_PARAMS = array (
  'pretty' => 'pretty',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
