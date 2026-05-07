<?php

namespace OpenCompany\Integrations\Kubernetes\Tools;

/**
 * Read internal apiserver v 1 alpha 1 storage version.
 *
 * Maps to the official Kubernetes endpoint get /apis/internal.apiserver.k8s.io/v1alpha1/storageversions/{name}.
 */
class KubernetesReadInternalApiserverV1Alpha1StorageVersion extends AbstractKubernetesTool
{
    protected const NAME = 'kubernetes_read_internal_apiserver_v1_alpha1_storage_version';
    protected const DESCRIPTION = 'Read internal apiserver v 1 alpha 1 storage version

Official Kubernetes endpoint: GET /apis/internal.apiserver.k8s.io/v1alpha1/storageversions/{name}

read the specified StorageVersion';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'description' => 'name of the StorageVersion',
    'required' => true,
  ),
  'pretty' =>
  array (
    'type' => 'string',
    'description' => 'If \'true\', then the output is pretty printed. Defaults to \'false\' unless the user-agent indicates a browser or command-line HTTP tool (curl and wget).',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/apis/internal.apiserver.k8s.io/v1alpha1/storageversions/{name}';
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
