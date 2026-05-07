<?php

namespace OpenCompany\Integrations\Kubernetes\Tools;

/**
 * Read policy v 1 namespaced pod disruption budget.
 *
 * Maps to the official Kubernetes endpoint get /apis/policy/v1/namespaces/{namespace}/poddisruptionbudgets/{name}.
 */
class KubernetesReadPolicyV1NamespacedPodDisruptionBudget extends AbstractKubernetesTool
{
    protected const NAME = 'kubernetes_read_policy_v1_namespaced_pod_disruption_budget';
    protected const DESCRIPTION = 'Read policy v 1 namespaced pod disruption budget

Official Kubernetes endpoint: GET /apis/policy/v1/namespaces/{namespace}/poddisruptionbudgets/{name}

read the specified PodDisruptionBudget';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'description' => 'name of the PodDisruptionBudget',
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
    protected const PATH = '/apis/policy/v1/namespaces/{namespace}/poddisruptionbudgets/{name}';
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
