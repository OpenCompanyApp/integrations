<?php

namespace OpenCompany\Integrations\Kubernetes\Tools;

/**
 * Connect core v 1 get namespaced pod portforward.
 *
 * Maps to the official Kubernetes endpoint get /api/v1/namespaces/{namespace}/pods/{name}/portforward.
 */
class KubernetesConnectCoreV1GetNamespacedPodPortforward extends AbstractKubernetesTool
{
    protected const NAME = 'kubernetes_connect_core_v1_get_namespaced_pod_portforward';
    protected const DESCRIPTION = 'Connect core v 1 get namespaced pod portforward

Official Kubernetes endpoint: GET /api/v1/namespaces/{namespace}/pods/{name}/portforward

connect GET requests to portforward of Pod';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'description' => 'name of the PodPortForwardOptions',
    'required' => true,
  ),
  'namespace' =>
  array (
    'type' => 'string',
    'description' => 'object name and auth scope, such as for teams and projects',
    'required' => true,
  ),
  'ports' =>
  array (
    'type' => 'integer',
    'description' => 'List of ports to forward Required when using WebSockets',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/v1/namespaces/{namespace}/pods/{name}/portforward';
    protected const PATH_PARAMS = array (
  'name' => 'name',
  'namespace' => 'namespace',
);
    protected const QUERY_PARAMS = array (
  'ports' => 'ports',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
