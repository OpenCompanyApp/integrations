<?php

namespace OpenCompany\Integrations\Kubernetes\Tools;

/**
 * Connect core v 1 patch namespaced pod proxy with path.
 *
 * Maps to the official Kubernetes endpoint patch /api/v1/namespaces/{namespace}/pods/{name}/proxy/{path}.
 */
class KubernetesConnectCoreV1PatchNamespacedPodProxyWithPath extends AbstractKubernetesTool
{
    protected const NAME = 'kubernetes_connect_core_v1_patch_namespaced_pod_proxy_with_path';
    protected const DESCRIPTION = 'Connect core v 1 patch namespaced pod proxy with path

Official Kubernetes endpoint: PATCH /api/v1/namespaces/{namespace}/pods/{name}/proxy/{path}

connect PATCH requests to proxy of Pod';
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
    protected const METHOD = 'patch';
    protected const PATH = '/api/v1/namespaces/{namespace}/pods/{name}/proxy/{path}';
    protected const PATH_PARAMS = array (
  'name' => 'name',
  'namespace' => 'namespace',
  'path' => 'path',
);
    protected const QUERY_PARAMS = array (
  'path' => 'path',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
