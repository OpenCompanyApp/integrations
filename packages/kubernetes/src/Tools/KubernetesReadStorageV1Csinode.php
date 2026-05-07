<?php

namespace OpenCompany\Integrations\Kubernetes\Tools;

/**
 * Read storage v 1 csinode.
 *
 * Maps to the official Kubernetes endpoint get /apis/storage.k8s.io/v1/csinodes/{name}.
 */
class KubernetesReadStorageV1Csinode extends AbstractKubernetesTool
{
    protected const NAME = 'kubernetes_read_storage_v1_csinode';
    protected const DESCRIPTION = 'Read storage v 1 csinode

Official Kubernetes endpoint: GET /apis/storage.k8s.io/v1/csinodes/{name}

read the specified CSINode';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'description' => 'name of the CSINode',
    'required' => true,
  ),
  'pretty' =>
  array (
    'type' => 'string',
    'description' => 'If \'true\', then the output is pretty printed. Defaults to \'false\' unless the user-agent indicates a browser or command-line HTTP tool (curl and wget).',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/apis/storage.k8s.io/v1/csinodes/{name}';
    protected const PATH_PARAMS = array (
  'name' => 'name',
);
    protected const QUERY_PARAMS = array (
  'pretty' => 'pretty',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
