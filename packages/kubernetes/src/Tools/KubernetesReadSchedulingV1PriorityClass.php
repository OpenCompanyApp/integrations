<?php

namespace OpenCompany\Integrations\Kubernetes\Tools;

/**
 * Read scheduling v 1 priority class.
 *
 * Maps to the official Kubernetes endpoint get /apis/scheduling.k8s.io/v1/priorityclasses/{name}.
 */
class KubernetesReadSchedulingV1PriorityClass extends AbstractKubernetesTool
{
    protected const NAME = 'kubernetes_read_scheduling_v1_priority_class';
    protected const DESCRIPTION = 'Read scheduling v 1 priority class

Official Kubernetes endpoint: GET /apis/scheduling.k8s.io/v1/priorityclasses/{name}

read the specified PriorityClass';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'description' => 'name of the PriorityClass',
    'required' => true,
  ),
  'pretty' =>
  array (
    'type' => 'string',
    'description' => 'If \'true\', then the output is pretty printed. Defaults to \'false\' unless the user-agent indicates a browser or command-line HTTP tool (curl and wget).',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/apis/scheduling.k8s.io/v1/priorityclasses/{name}';
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
