<?php

namespace OpenCompany\Integrations\Kubernetes\Tools;

/**
 * Read discovery v 1 namespaced endpoint slice.
 *
 * Maps to the official Kubernetes endpoint get /apis/discovery.k8s.io/v1/namespaces/{namespace}/endpointslices/{name}.
 */
class KubernetesReadDiscoveryV1NamespacedEndpointSlice extends AbstractKubernetesTool
{
    protected const NAME = 'kubernetes_read_discovery_v1_namespaced_endpoint_slice';
    protected const DESCRIPTION = 'Read discovery v 1 namespaced endpoint slice

Official Kubernetes endpoint: GET /apis/discovery.k8s.io/v1/namespaces/{namespace}/endpointslices/{name}

read the specified EndpointSlice';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'description' => 'name of the EndpointSlice',
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
    protected const PATH = '/apis/discovery.k8s.io/v1/namespaces/{namespace}/endpointslices/{name}';
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
