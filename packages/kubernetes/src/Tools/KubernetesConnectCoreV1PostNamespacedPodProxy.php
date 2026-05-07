<?php

namespace OpenCompany\Integrations\Kubernetes\Tools;

/**
 * Connect core v 1 post namespaced pod proxy.
 *
 * Maps to the official Kubernetes endpoint post /api/v1/namespaces/{namespace}/pods/{name}/proxy.
 */
class KubernetesConnectCoreV1PostNamespacedPodProxy extends AbstractKubernetesTool
{
    protected const NAME = 'kubernetes_connect_core_v1_post_namespaced_pod_proxy';
    protected const DESCRIPTION = 'Connect core v 1 post namespaced pod proxy

Official Kubernetes endpoint: POST /api/v1/namespaces/{namespace}/pods/{name}/proxy

connect POST requests to proxy of Pod';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'description' => 'name of the PodProxyOptions',
    'required' => true,
  ),
  'namespace' =>
  array (
    'type' => 'string',
    'description' => 'object name and auth scope, such as for teams and projects',
    'required' => true,
  ),
  'path' =>
  array (
    'type' => 'string',
    'description' => 'Path is the URL path to use for the current proxy request to pod.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/v1/namespaces/{namespace}/pods/{name}/proxy';
    protected const PATH_PARAMS = array (
  'name' => 'name',
  'namespace' => 'namespace',
);
    protected const QUERY_PARAMS = array (
  'path' => 'path',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
