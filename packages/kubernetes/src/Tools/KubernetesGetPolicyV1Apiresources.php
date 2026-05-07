<?php

namespace OpenCompany\Integrations\Kubernetes\Tools;

/**
 * Get policy v 1 apiresources.
 *
 * Maps to the official Kubernetes endpoint get /apis/policy/v1/.
 */
class KubernetesGetPolicyV1Apiresources extends AbstractKubernetesTool
{
    protected const NAME = 'kubernetes_get_policy_v1_apiresources';
    protected const DESCRIPTION = 'Get policy v 1 apiresources

Official Kubernetes endpoint: GET /apis/policy/v1/

get available resources';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/apis/policy/v1/';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
