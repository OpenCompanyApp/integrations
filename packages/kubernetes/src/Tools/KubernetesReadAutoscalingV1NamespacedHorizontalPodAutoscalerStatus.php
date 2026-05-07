<?php

namespace OpenCompany\Integrations\Kubernetes\Tools;

/**
 * Read autoscaling v 1 namespaced horizontal pod autoscaler status.
 *
 * Maps to the official Kubernetes endpoint get /apis/autoscaling/v1/namespaces/{namespace}/horizontalpodautoscalers/{name}/status.
 */
class KubernetesReadAutoscalingV1NamespacedHorizontalPodAutoscalerStatus extends AbstractKubernetesTool
{
    protected const NAME = 'kubernetes_read_autoscaling_v1_namespaced_horizontal_pod_autoscaler_status';
    protected const DESCRIPTION = 'Read autoscaling v 1 namespaced horizontal pod autoscaler status

Official Kubernetes endpoint: GET /apis/autoscaling/v1/namespaces/{namespace}/horizontalpodautoscalers/{name}/status

read status of the specified HorizontalPodAutoscaler';
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
    protected const PATH = '/apis/autoscaling/v1/namespaces/{namespace}/horizontalpodautoscalers/{name}/status';
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
