<?php

namespace OpenCompany\Integrations\Kubernetes\Tools;

/**
 * Read scheduling v 1 alpha 2 namespaced pod group.
 *
 * Maps to the official Kubernetes endpoint get /apis/scheduling.k8s.io/v1alpha2/namespaces/{namespace}/podgroups/{name}.
 */
class KubernetesReadSchedulingV1Alpha2NamespacedPodGroup extends AbstractKubernetesTool
{
    protected const NAME = 'kubernetes_read_scheduling_v1_alpha2_namespaced_pod_group';
    protected const DESCRIPTION = 'Read scheduling v 1 alpha 2 namespaced pod group

Official Kubernetes endpoint: GET /apis/scheduling.k8s.io/v1alpha2/namespaces/{namespace}/podgroups/{name}

read the specified PodGroup';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'description' => 'name of the PodGroup',
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
    protected const PATH = '/apis/scheduling.k8s.io/v1alpha2/namespaces/{namespace}/podgroups/{name}';
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
