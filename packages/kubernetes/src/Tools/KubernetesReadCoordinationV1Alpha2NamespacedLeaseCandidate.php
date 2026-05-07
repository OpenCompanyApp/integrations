<?php

namespace OpenCompany\Integrations\Kubernetes\Tools;

/**
 * Read coordination v 1 alpha 2 namespaced lease candidate.
 *
 * Maps to the official Kubernetes endpoint get /apis/coordination.k8s.io/v1alpha2/namespaces/{namespace}/leasecandidates/{name}.
 */
class KubernetesReadCoordinationV1Alpha2NamespacedLeaseCandidate extends AbstractKubernetesTool
{
    protected const NAME = 'kubernetes_read_coordination_v1_alpha2_namespaced_lease_candidate';
    protected const DESCRIPTION = 'Read coordination v 1 alpha 2 namespaced lease candidate

Official Kubernetes endpoint: GET /apis/coordination.k8s.io/v1alpha2/namespaces/{namespace}/leasecandidates/{name}

read the specified LeaseCandidate';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'description' => 'name of the LeaseCandidate',
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
    protected const PATH = '/apis/coordination.k8s.io/v1alpha2/namespaces/{namespace}/leasecandidates/{name}';
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
