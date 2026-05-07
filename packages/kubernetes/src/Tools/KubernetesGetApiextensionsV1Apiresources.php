<?php

namespace OpenCompany\Integrations\Kubernetes\Tools;

/**
 * Get apiextensions v 1 apiresources.
 *
 * Maps to the official Kubernetes endpoint get /apis/apiextensions.k8s.io/v1/.
 */
class KubernetesGetApiextensionsV1Apiresources extends AbstractKubernetesTool
{
    protected const NAME = 'kubernetes_get_apiextensions_v1_apiresources';
    protected const DESCRIPTION = 'Get apiextensions v 1 apiresources

Official Kubernetes endpoint: GET /apis/apiextensions.k8s.io/v1/

get available resources';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/apis/apiextensions.k8s.io/v1/';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
