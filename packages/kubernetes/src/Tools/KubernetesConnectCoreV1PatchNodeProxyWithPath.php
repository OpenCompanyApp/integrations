<?php

namespace OpenCompany\Integrations\Kubernetes\Tools;

/**
 * Connect core v 1 patch node proxy with path.
 *
 * Maps to the official Kubernetes endpoint patch /api/v1/nodes/{name}/proxy/{path}.
 */
class KubernetesConnectCoreV1PatchNodeProxyWithPath extends AbstractKubernetesTool
{
    protected const NAME = 'kubernetes_connect_core_v1_patch_node_proxy_with_path';
    protected const DESCRIPTION = 'Connect core v 1 patch node proxy with path

Official Kubernetes endpoint: PATCH /api/v1/nodes/{name}/proxy/{path}

connect PATCH requests to proxy of Node';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'description' => 'name of the NodeProxyOptions',
    'required' => true,
  ),
  'path' =>
  array (
    'type' => 'string',
    'description' => 'Path is the URL path to use for the current proxy request to node.',
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/api/v1/nodes/{name}/proxy/{path}';
    protected const PATH_PARAMS = array (
  'name' => 'name',
  'path' => 'path',
);
    protected const QUERY_PARAMS = array (
  'path' => 'path',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
