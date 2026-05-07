<?php

namespace OpenCompany\Integrations\Kubernetes\Tools;

/**
 * Read batch v 1 namespaced cron job.
 *
 * Maps to the official Kubernetes endpoint get /apis/batch/v1/namespaces/{namespace}/cronjobs/{name}.
 */
class KubernetesReadBatchV1NamespacedCronJob extends AbstractKubernetesTool
{
    protected const NAME = 'kubernetes_read_batch_v1_namespaced_cron_job';
    protected const DESCRIPTION = 'Read batch v 1 namespaced cron job

Official Kubernetes endpoint: GET /apis/batch/v1/namespaces/{namespace}/cronjobs/{name}

read the specified CronJob';
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
    protected const PATH = '/apis/batch/v1/namespaces/{namespace}/cronjobs/{name}';
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
