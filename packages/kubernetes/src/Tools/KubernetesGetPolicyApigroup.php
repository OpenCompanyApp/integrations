<?php

namespace OpenCompany\Integrations\Kubernetes\Tools;

/**
 * Get policy apigroup.
 *
 * Maps to the official Kubernetes endpoint get /apis/policy/.
 */
class KubernetesGetPolicyApigroup extends AbstractKubernetesTool
{
    protected const NAME = 'kubernetes_get_policy_apigroup';
    protected const DESCRIPTION = 'Get policy apigroup

Official Kubernetes endpoint: GET /apis/policy/

get information of a group';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/apis/policy/';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
