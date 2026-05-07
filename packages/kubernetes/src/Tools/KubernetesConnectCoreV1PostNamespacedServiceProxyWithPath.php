<?php

namespace OpenCompany\Integrations\Kubernetes\Tools;

/**
 * Connect core v 1 post namespaced service proxy with path.
 *
 * Maps to the official Kubernetes endpoint post /api/v1/namespaces/{namespace}/services/{name}/proxy/{path}.
 */
class KubernetesConnectCoreV1PostNamespacedServiceProxyWithPath extends AbstractKubernetesTool
{
    protected const NAME = 'kubernetes_connect_core_v1_post_namespaced_service_proxy_with_path';
    protected const DESCRIPTION = 'Connect core v 1 post namespaced service proxy with path

Official Kubernetes endpoint: POST /api/v1/namespaces/{namespace}/services/{name}/proxy/{path}

connect POST requests to proxy of Service';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'description' => 'name of the ServiceProxyOptions',
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
    'description' => 'Path is the part of URLs that include service endpoints, suffixes, and parameters to use for the current proxy request to service. For example, the whole request URL is http://localhost/api/v1/namespaces/kube-system/services/elasticsearch-logging/_search?q=user:kimchy. Path is _search?q=user:kimchy.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/v1/namespaces/{namespace}/services/{name}/proxy/{path}';
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
