<?php

namespace OpenCompany\Integrations\Kubernetes\Tools;

/**
 * Get authentication v 1 apiresources.
 *
 * Maps to the official Kubernetes endpoint get /apis/authentication.k8s.io/v1/.
 */
class KubernetesGetAuthenticationV1Apiresources extends AbstractKubernetesTool
{
    protected const NAME = 'kubernetes_get_authentication_v1_apiresources';
    protected const DESCRIPTION = 'Get authentication v 1 apiresources

Official Kubernetes endpoint: GET /apis/authentication.k8s.io/v1/

get available resources';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/apis/authentication.k8s.io/v1/';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
