<?php

namespace OpenCompany\Integrations\Kubernetes\Tools;

/**
 * Read apiextensions v 1 custom resource definition status.
 *
 * Maps to the official Kubernetes endpoint get /apis/apiextensions.k8s.io/v1/customresourcedefinitions/{name}/status.
 */
class KubernetesReadApiextensionsV1CustomResourceDefinitionStatus extends AbstractKubernetesTool
{
    protected const NAME = 'kubernetes_read_apiextensions_v1_custom_resource_definition_status';
    protected const DESCRIPTION = 'Read apiextensions v 1 custom resource definition status

Official Kubernetes endpoint: GET /apis/apiextensions.k8s.io/v1/customresourcedefinitions/{name}/status

read status of the specified CustomResourceDefinition';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'description' => 'name of the CustomResourceDefinition',
    'required' => true,
  ),
  'pretty' =>
  array (
    'type' => 'string',
    'description' => 'If \'true\', then the output is pretty printed. Defaults to \'false\' unless the user-agent indicates a browser or command-line HTTP tool (curl and wget).',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/apis/apiextensions.k8s.io/v1/customresourcedefinitions/{name}/status';
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
