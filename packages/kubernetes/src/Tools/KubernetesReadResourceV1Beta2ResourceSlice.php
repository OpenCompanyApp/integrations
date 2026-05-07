<?php

namespace OpenCompany\Integrations\Kubernetes\Tools;

/**
 * Read resource v 1 beta 2 resource slice.
 *
 * Maps to the official Kubernetes endpoint get /apis/resource.k8s.io/v1beta2/resourceslices/{name}.
 */
class KubernetesReadResourceV1Beta2ResourceSlice extends AbstractKubernetesTool
{
    protected const NAME = 'kubernetes_read_resource_v1_beta2_resource_slice';
    protected const DESCRIPTION = 'Read resource v 1 beta 2 resource slice

Official Kubernetes endpoint: GET /apis/resource.k8s.io/v1beta2/resourceslices/{name}

read the specified ResourceSlice';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'description' => 'name of the ResourceSlice',
    'required' => true,
  ),
  'pretty' =>
  array (
    'type' => 'string',
    'description' => 'If \'true\', then the output is pretty printed. Defaults to \'false\' unless the user-agent indicates a browser or command-line HTTP tool (curl and wget).',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/apis/resource.k8s.io/v1beta2/resourceslices/{name}';
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
