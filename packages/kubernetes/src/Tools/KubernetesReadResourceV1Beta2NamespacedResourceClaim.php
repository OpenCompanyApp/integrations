<?php

namespace OpenCompany\Integrations\Kubernetes\Tools;

/**
 * Read resource v 1 beta 2 namespaced resource claim.
 *
 * Maps to the official Kubernetes endpoint get /apis/resource.k8s.io/v1beta2/namespaces/{namespace}/resourceclaims/{name}.
 */
class KubernetesReadResourceV1Beta2NamespacedResourceClaim extends AbstractKubernetesTool
{
    protected const NAME = 'kubernetes_read_resource_v1_beta2_namespaced_resource_claim';
    protected const DESCRIPTION = 'Read resource v 1 beta 2 namespaced resource claim

Official Kubernetes endpoint: GET /apis/resource.k8s.io/v1beta2/namespaces/{namespace}/resourceclaims/{name}

read the specified ResourceClaim';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'description' => 'name of the ResourceClaim',
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
    protected const PATH = '/apis/resource.k8s.io/v1beta2/namespaces/{namespace}/resourceclaims/{name}';
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
