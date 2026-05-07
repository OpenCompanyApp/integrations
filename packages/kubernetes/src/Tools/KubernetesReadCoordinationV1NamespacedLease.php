<?php

namespace OpenCompany\Integrations\Kubernetes\Tools;

/**
 * Read coordination v 1 namespaced lease.
 *
 * Maps to the official Kubernetes endpoint get /apis/coordination.k8s.io/v1/namespaces/{namespace}/leases/{name}.
 */
class KubernetesReadCoordinationV1NamespacedLease extends AbstractKubernetesTool
{
    protected const NAME = 'kubernetes_read_coordination_v1_namespaced_lease';
    protected const DESCRIPTION = 'Read coordination v 1 namespaced lease

Official Kubernetes endpoint: GET /apis/coordination.k8s.io/v1/namespaces/{namespace}/leases/{name}

read the specified Lease';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'description' => 'name of the Lease',
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
    protected const PATH = '/apis/coordination.k8s.io/v1/namespaces/{namespace}/leases/{name}';
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
