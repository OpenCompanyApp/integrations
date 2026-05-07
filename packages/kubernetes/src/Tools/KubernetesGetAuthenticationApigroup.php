<?php

namespace OpenCompany\Integrations\Kubernetes\Tools;

/**
 * Get authentication apigroup.
 *
 * Maps to the official Kubernetes endpoint get /apis/authentication.k8s.io/.
 */
class KubernetesGetAuthenticationApigroup extends AbstractKubernetesTool
{
    protected const NAME = 'kubernetes_get_authentication_apigroup';
    protected const DESCRIPTION = 'Get authentication apigroup

Official Kubernetes endpoint: GET /apis/authentication.k8s.io/

get information of a group';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/apis/authentication.k8s.io/';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
