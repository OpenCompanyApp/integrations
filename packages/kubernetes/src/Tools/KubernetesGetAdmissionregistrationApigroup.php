<?php

namespace OpenCompany\Integrations\Kubernetes\Tools;

/**
 * Get admissionregistration apigroup.
 *
 * Maps to the official Kubernetes endpoint get /apis/admissionregistration.k8s.io/.
 */
class KubernetesGetAdmissionregistrationApigroup extends AbstractKubernetesTool
{
    protected const NAME = 'kubernetes_get_admissionregistration_apigroup';
    protected const DESCRIPTION = 'Get admissionregistration apigroup

Official Kubernetes endpoint: GET /apis/admissionregistration.k8s.io/

get information of a group';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/apis/admissionregistration.k8s.io/';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
