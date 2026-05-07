<?php

namespace OpenCompany\Integrations\Kubernetes\Tools;

/**
 * Get batch apigroup.
 *
 * Maps to the official Kubernetes endpoint get /apis/batch/.
 */
class KubernetesGetBatchApigroup extends AbstractKubernetesTool
{
    protected const NAME = 'kubernetes_get_batch_apigroup';
    protected const DESCRIPTION = 'Get batch apigroup

Official Kubernetes endpoint: GET /apis/batch/

get information of a group';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/apis/batch/';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
