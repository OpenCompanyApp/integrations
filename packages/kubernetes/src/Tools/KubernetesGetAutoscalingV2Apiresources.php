<?php

namespace OpenCompany\Integrations\Kubernetes\Tools;

/**
 * Get autoscaling v 2 apiresources.
 *
 * Maps to the official Kubernetes endpoint get /apis/autoscaling/v2/.
 */
class KubernetesGetAutoscalingV2Apiresources extends AbstractKubernetesTool
{
    protected const NAME = 'kubernetes_get_autoscaling_v2_apiresources';
    protected const DESCRIPTION = 'Get autoscaling v 2 apiresources

Official Kubernetes endpoint: GET /apis/autoscaling/v2/

get available resources';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/apis/autoscaling/v2/';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
