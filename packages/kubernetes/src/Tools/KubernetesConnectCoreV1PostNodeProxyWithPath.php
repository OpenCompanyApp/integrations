<?php

namespace OpenCompany\Integrations\Kubernetes\Tools;

/**
 * Connect core v 1 post node proxy with path.
 *
 * Maps to the official Kubernetes endpoint post /api/v1/nodes/{name}/proxy/{path}.
 */
class KubernetesConnectCoreV1PostNodeProxyWithPath extends AbstractKubernetesTool
{
    protected const NAME = 'kubernetes_connect_core_v1_post_node_proxy_with_path';
    protected const DESCRIPTION = 'Connect core v 1 post node proxy with path

Official Kubernetes endpoint: POST /api/v1/nodes/{name}/proxy/{path}

connect POST requests to proxy of Node';
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
    protected const METHOD = 'post';
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
