<?php

namespace OpenCompany\Integrations\Kubernetes\Tools;

/**
 * Get flowcontrol apiserver apigroup.
 *
 * Maps to the official Kubernetes endpoint get /apis/flowcontrol.apiserver.k8s.io/.
 */
class KubernetesGetFlowcontrolApiserverApigroup extends AbstractKubernetesTool
{
    protected const NAME = 'kubernetes_get_flowcontrol_apiserver_apigroup';
    protected const DESCRIPTION = 'Get flowcontrol apiserver apigroup

Official Kubernetes endpoint: GET /apis/flowcontrol.apiserver.k8s.io/

get information of a group';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/apis/flowcontrol.apiserver.k8s.io/';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
