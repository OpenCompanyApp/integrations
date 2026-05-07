<?php

namespace OpenCompany\Integrations\Kubernetes\Tools;

/**
 * Get storage apigroup.
 *
 * Maps to the official Kubernetes endpoint get /apis/storage.k8s.io/.
 */
class KubernetesGetStorageApigroup extends AbstractKubernetesTool
{
    protected const NAME = 'kubernetes_get_storage_apigroup';
    protected const DESCRIPTION = 'Get storage apigroup

Official Kubernetes endpoint: GET /apis/storage.k8s.io/

get information of a group';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/apis/storage.k8s.io/';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
