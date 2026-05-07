<?php

namespace OpenCompany\Integrations\Kubernetes\Tools;

/**
 * Get authorization apigroup.
 *
 * Maps to the official Kubernetes endpoint get /apis/authorization.k8s.io/.
 */
class KubernetesGetAuthorizationApigroup extends AbstractKubernetesTool
{
    protected const NAME = 'kubernetes_get_authorization_apigroup';
    protected const DESCRIPTION = 'Get authorization apigroup

Official Kubernetes endpoint: GET /apis/authorization.k8s.io/

get information of a group';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/apis/authorization.k8s.io/';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
