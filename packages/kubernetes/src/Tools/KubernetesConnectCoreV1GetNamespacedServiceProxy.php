<?php

namespace OpenCompany\Integrations\Kubernetes\Tools;

/**
 * Connect core v 1 get namespaced service proxy.
 *
 * Maps to the official Kubernetes endpoint get /api/v1/namespaces/{namespace}/services/{name}/proxy.
 */
class KubernetesConnectCoreV1GetNamespacedServiceProxy extends AbstractKubernetesTool
{
    protected const NAME = 'kubernetes_connect_core_v1_get_namespaced_service_proxy';
    protected const DESCRIPTION = 'Connect core v 1 get namespaced service proxy

Official Kubernetes endpoint: GET /api/v1/namespaces/{namespace}/services/{name}/proxy

connect GET requests to proxy of Service';
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
    protected const METHOD = 'get';
    protected const PATH = '/api/v1/namespaces/{namespace}/services/{name}/proxy';
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
