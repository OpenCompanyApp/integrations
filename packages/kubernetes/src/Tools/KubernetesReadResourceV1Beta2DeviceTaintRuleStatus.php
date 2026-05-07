<?php

namespace OpenCompany\Integrations\Kubernetes\Tools;

/**
 * Read resource v 1 beta 2 device taint rule status.
 *
 * Maps to the official Kubernetes endpoint get /apis/resource.k8s.io/v1beta2/devicetaintrules/{name}/status.
 */
class KubernetesReadResourceV1Beta2DeviceTaintRuleStatus extends AbstractKubernetesTool
{
    protected const NAME = 'kubernetes_read_resource_v1_beta2_device_taint_rule_status';
    protected const DESCRIPTION = 'Read resource v 1 beta 2 device taint rule status

Official Kubernetes endpoint: GET /apis/resource.k8s.io/v1beta2/devicetaintrules/{name}/status

read status of the specified DeviceTaintRule';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'description' => 'name of the DeviceTaintRule',
    'required' => true,
  ),
  'pretty' =>
  array (
    'type' => 'string',
    'description' => 'If \'true\', then the output is pretty printed. Defaults to \'false\' unless the user-agent indicates a browser or command-line HTTP tool (curl and wget).',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/apis/resource.k8s.io/v1beta2/devicetaintrules/{name}/status';
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
