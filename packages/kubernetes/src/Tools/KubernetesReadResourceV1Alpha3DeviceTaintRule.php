<?php

namespace OpenCompany\Integrations\Kubernetes\Tools;

/**
 * Read resource v 1 alpha 3 device taint rule.
 *
 * Maps to the official Kubernetes endpoint get /apis/resource.k8s.io/v1alpha3/devicetaintrules/{name}.
 */
class KubernetesReadResourceV1Alpha3DeviceTaintRule extends AbstractKubernetesTool
{
    protected const NAME = 'kubernetes_read_resource_v1_alpha3_device_taint_rule';
    protected const DESCRIPTION = 'Read resource v 1 alpha 3 device taint rule

Official Kubernetes endpoint: GET /apis/resource.k8s.io/v1alpha3/devicetaintrules/{name}

read the specified DeviceTaintRule';
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
    protected const PATH = '/apis/resource.k8s.io/v1alpha3/devicetaintrules/{name}';
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
