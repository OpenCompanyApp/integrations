<?php

namespace OpenCompany\Integrations\Kubernetes\Tools;

/**
 * Read node v 1 runtime class.
 *
 * Maps to the official Kubernetes endpoint get /apis/node.k8s.io/v1/runtimeclasses/{name}.
 */
class KubernetesReadNodeV1RuntimeClass extends AbstractKubernetesTool
{
    protected const NAME = 'kubernetes_read_node_v1_runtime_class';
    protected const DESCRIPTION = 'Read node v 1 runtime class

Official Kubernetes endpoint: GET /apis/node.k8s.io/v1/runtimeclasses/{name}

read the specified RuntimeClass';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'description' => 'name of the RuntimeClass',
    'required' => true,
  ),
  'pretty' =>
  array (
    'type' => 'string',
    'description' => 'If \'true\', then the output is pretty printed. Defaults to \'false\' unless the user-agent indicates a browser or command-line HTTP tool (curl and wget).',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/apis/node.k8s.io/v1/runtimeclasses/{name}';
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
