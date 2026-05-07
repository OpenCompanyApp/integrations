<?php

namespace OpenCompany\Integrations\Kubernetes\Tools;

/**
 * Read storage v 1 csidriver.
 *
 * Maps to the official Kubernetes endpoint get /apis/storage.k8s.io/v1/csidrivers/{name}.
 */
class KubernetesReadStorageV1Csidriver extends AbstractKubernetesTool
{
    protected const NAME = 'kubernetes_read_storage_v1_csidriver';
    protected const DESCRIPTION = 'Read storage v 1 csidriver

Official Kubernetes endpoint: GET /apis/storage.k8s.io/v1/csidrivers/{name}

read the specified CSIDriver';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'description' => 'name of the CSIDriver',
    'required' => true,
  ),
  'pretty' =>
  array (
    'type' => 'string',
    'description' => 'If \'true\', then the output is pretty printed. Defaults to \'false\' unless the user-agent indicates a browser or command-line HTTP tool (curl and wget).',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/apis/storage.k8s.io/v1/csidrivers/{name}';
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
