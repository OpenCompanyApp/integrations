<?php

namespace OpenCompany\Integrations\Kubernetes\Tools;

/**
 * Get apiextensions apigroup.
 *
 * Maps to the official Kubernetes endpoint get /apis/apiextensions.k8s.io/.
 */
class KubernetesGetApiextensionsApigroup extends AbstractKubernetesTool
{
    protected const NAME = 'kubernetes_get_apiextensions_apigroup';
    protected const DESCRIPTION = 'Get apiextensions apigroup

Official Kubernetes endpoint: GET /apis/apiextensions.k8s.io/

get information of a group';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/apis/apiextensions.k8s.io/';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
