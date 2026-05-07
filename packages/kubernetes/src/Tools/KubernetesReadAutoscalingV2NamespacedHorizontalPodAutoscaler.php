<?php

namespace OpenCompany\Integrations\Kubernetes\Tools;

/**
 * Read autoscaling v 2 namespaced horizontal pod autoscaler.
 *
 * Maps to the official Kubernetes endpoint get /apis/autoscaling/v2/namespaces/{namespace}/horizontalpodautoscalers/{name}.
 */
class KubernetesReadAutoscalingV2NamespacedHorizontalPodAutoscaler extends AbstractKubernetesTool
{
    protected const NAME = 'kubernetes_read_autoscaling_v2_namespaced_horizontal_pod_autoscaler';
    protected const DESCRIPTION = 'Read autoscaling v 2 namespaced horizontal pod autoscaler

Official Kubernetes endpoint: GET /apis/autoscaling/v2/namespaces/{namespace}/horizontalpodautoscalers/{name}

read the specified HorizontalPodAutoscaler';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'description' => 'name of the HorizontalPodAutoscaler',
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
    protected const PATH = '/apis/autoscaling/v2/namespaces/{namespace}/horizontalpodautoscalers/{name}';
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
