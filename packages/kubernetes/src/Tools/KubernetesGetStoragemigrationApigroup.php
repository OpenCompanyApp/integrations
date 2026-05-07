<?php

namespace OpenCompany\Integrations\Kubernetes\Tools;

/**
 * Get storagemigration apigroup.
 *
 * Maps to the official Kubernetes endpoint get /apis/storagemigration.k8s.io/.
 */
class KubernetesGetStoragemigrationApigroup extends AbstractKubernetesTool
{
    protected const NAME = 'kubernetes_get_storagemigration_apigroup';
    protected const DESCRIPTION = 'Get storagemigration apigroup

Official Kubernetes endpoint: GET /apis/storagemigration.k8s.io/

get information of a group';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/apis/storagemigration.k8s.io/';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
