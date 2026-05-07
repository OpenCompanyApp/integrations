<?php

namespace OpenCompany\Integrations\Kubernetes\Tools;

/**
 * Read core v 1 namespace.
 *
 * Maps to the official Kubernetes endpoint get /api/v1/namespaces/{name}.
 */
class KubernetesReadCoreV1Namespace extends AbstractKubernetesTool
{
    protected const NAME = 'kubernetes_read_core_v1_namespace';
    protected const DESCRIPTION = 'Read core v 1 namespace

Official Kubernetes endpoint: GET /api/v1/namespaces/{name}

read the specified Namespace';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'description' => 'name of the Namespace',
    'required' => true,
  ),
  'pretty' =>
  array (
    'type' => 'string',
    'description' => 'If \'true\', then the output is pretty printed. Defaults to \'false\' unless the user-agent indicates a browser or command-line HTTP tool (curl and wget).',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/v1/namespaces/{name}';
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
