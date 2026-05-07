<?php

namespace OpenCompany\Integrations\Kubernetes\Tools;

/**
 * Read networking v 1 namespaced ingress status.
 *
 * Maps to the official Kubernetes endpoint get /apis/networking.k8s.io/v1/namespaces/{namespace}/ingresses/{name}/status.
 */
class KubernetesReadNetworkingV1NamespacedIngressStatus extends AbstractKubernetesTool
{
    protected const NAME = 'kubernetes_read_networking_v1_namespaced_ingress_status';
    protected const DESCRIPTION = 'Read networking v 1 namespaced ingress status

Official Kubernetes endpoint: GET /apis/networking.k8s.io/v1/namespaces/{namespace}/ingresses/{name}/status

read status of the specified Ingress';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'description' => 'name of the Ingress',
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
    protected const PATH = '/apis/networking.k8s.io/v1/namespaces/{namespace}/ingresses/{name}/status';
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
