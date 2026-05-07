<?php

namespace OpenCompany\Integrations\Kubernetes\Tools;

/**
 * Get apiregistration apigroup.
 *
 * Maps to the official Kubernetes endpoint get /apis/apiregistration.k8s.io/.
 */
class KubernetesGetApiregistrationApigroup extends AbstractKubernetesTool
{
    protected const NAME = 'kubernetes_get_apiregistration_apigroup';
    protected const DESCRIPTION = 'Get apiregistration apigroup

Official Kubernetes endpoint: GET /apis/apiregistration.k8s.io/

get information of a group';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/apis/apiregistration.k8s.io/';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
