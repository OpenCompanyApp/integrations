<?php

namespace OpenCompany\Integrations\Kubernetes\Tools;

/**
 * Read networking v 1 namespaced network policy.
 *
 * Maps to the official Kubernetes endpoint get /apis/networking.k8s.io/v1/namespaces/{namespace}/networkpolicies/{name}.
 */
class KubernetesReadNetworkingV1NamespacedNetworkPolicy extends AbstractKubernetesTool
{
    protected const NAME = 'kubernetes_read_networking_v1_namespaced_network_policy';
    protected const DESCRIPTION = 'Read networking v 1 namespaced network policy

Official Kubernetes endpoint: GET /apis/networking.k8s.io/v1/namespaces/{namespace}/networkpolicies/{name}

read the specified NetworkPolicy';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'description' => 'name of the NetworkPolicy',
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
    protected const PATH = '/apis/networking.k8s.io/v1/namespaces/{namespace}/networkpolicies/{name}';
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
