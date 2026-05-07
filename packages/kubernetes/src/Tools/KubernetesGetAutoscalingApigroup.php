<?php

namespace OpenCompany\Integrations\Kubernetes\Tools;

/**
 * Get autoscaling apigroup.
 *
 * Maps to the official Kubernetes endpoint get /apis/autoscaling/.
 */
class KubernetesGetAutoscalingApigroup extends AbstractKubernetesTool
{
    protected const NAME = 'kubernetes_get_autoscaling_apigroup';
    protected const DESCRIPTION = 'Get autoscaling apigroup

Official Kubernetes endpoint: GET /apis/autoscaling/

get information of a group';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/apis/autoscaling/';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
