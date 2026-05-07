<?php

namespace OpenCompany\Integrations\Kubernetes\Tools;

/**
 * Read apps v 1 namespaced replica set scale.
 *
 * Maps to the official Kubernetes endpoint get /apis/apps/v1/namespaces/{namespace}/replicasets/{name}/scale.
 */
class KubernetesReadAppsV1NamespacedReplicaSetScale extends AbstractKubernetesTool
{
    protected const NAME = 'kubernetes_read_apps_v1_namespaced_replica_set_scale';
    protected const DESCRIPTION = 'Read apps v 1 namespaced replica set scale

Official Kubernetes endpoint: GET /apis/apps/v1/namespaces/{namespace}/replicasets/{name}/scale

read scale of the specified ReplicaSet';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'description' => 'name of the Scale',
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
    protected const PATH = '/apis/apps/v1/namespaces/{namespace}/replicasets/{name}/scale';
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
