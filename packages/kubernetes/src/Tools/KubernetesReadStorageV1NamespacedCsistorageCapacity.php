<?php

namespace OpenCompany\Integrations\Kubernetes\Tools;

/**
 * Read storage v 1 namespaced csistorage capacity.
 *
 * Maps to the official Kubernetes endpoint get /apis/storage.k8s.io/v1/namespaces/{namespace}/csistoragecapacities/{name}.
 */
class KubernetesReadStorageV1NamespacedCsistorageCapacity extends AbstractKubernetesTool
{
    protected const NAME = 'kubernetes_read_storage_v1_namespaced_csistorage_capacity';
    protected const DESCRIPTION = 'Read storage v 1 namespaced csistorage capacity

Official Kubernetes endpoint: GET /apis/storage.k8s.io/v1/namespaces/{namespace}/csistoragecapacities/{name}

read the specified CSIStorageCapacity';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'description' => 'name of the CSIStorageCapacity',
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
    protected const PATH = '/apis/storage.k8s.io/v1/namespaces/{namespace}/csistoragecapacities/{name}';
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
