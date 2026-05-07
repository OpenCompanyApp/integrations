<?php

namespace OpenCompany\Integrations\Kubernetes\Tools;

/**
 * Connect core v 1 delete node proxy.
 *
 * Maps to the official Kubernetes endpoint delete /api/v1/nodes/{name}/proxy.
 */
class KubernetesConnectCoreV1DeleteNodeProxy extends AbstractKubernetesTool
{
    protected const NAME = 'kubernetes_connect_core_v1_delete_node_proxy';
    protected const DESCRIPTION = 'Connect core v 1 delete node proxy

Official Kubernetes endpoint: DELETE /api/v1/nodes/{name}/proxy

connect DELETE requests to proxy of Node';
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
    protected const METHOD = 'delete';
    protected const PATH = '/api/v1/nodes/{name}/proxy';
    protected const PATH_PARAMS = array (
  'name' => 'name',
);
    protected const QUERY_PARAMS = array (
  'path' => 'path',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
