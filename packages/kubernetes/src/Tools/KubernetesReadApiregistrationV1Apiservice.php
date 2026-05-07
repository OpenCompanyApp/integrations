<?php

namespace OpenCompany\Integrations\Kubernetes\Tools;

/**
 * Read apiregistration v 1 apiservice.
 *
 * Maps to the official Kubernetes endpoint get /apis/apiregistration.k8s.io/v1/apiservices/{name}.
 */
class KubernetesReadApiregistrationV1Apiservice extends AbstractKubernetesTool
{
    protected const NAME = 'kubernetes_read_apiregistration_v1_apiservice';
    protected const DESCRIPTION = 'Read apiregistration v 1 apiservice

Official Kubernetes endpoint: GET /apis/apiregistration.k8s.io/v1/apiservices/{name}

read the specified APIService';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'description' => 'name of the APIService',
    'required' => true,
  ),
  'pretty' =>
  array (
    'type' => 'string',
    'description' => 'If \'true\', then the output is pretty printed. Defaults to \'false\' unless the user-agent indicates a browser or command-line HTTP tool (curl and wget).',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/apis/apiregistration.k8s.io/v1/apiservices/{name}';
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
