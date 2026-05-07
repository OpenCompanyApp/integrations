<?php

namespace OpenCompany\Integrations\Kubernetes\Tools;

/**
 * Get rbac authorization apigroup.
 *
 * Maps to the official Kubernetes endpoint get /apis/rbac.authorization.k8s.io/.
 */
class KubernetesGetRbacAuthorizationApigroup extends AbstractKubernetesTool
{
    protected const NAME = 'kubernetes_get_rbac_authorization_apigroup';
    protected const DESCRIPTION = 'Get rbac authorization apigroup

Official Kubernetes endpoint: GET /apis/rbac.authorization.k8s.io/

get information of a group';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/apis/rbac.authorization.k8s.io/';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
