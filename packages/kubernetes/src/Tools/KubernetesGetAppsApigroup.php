<?php

namespace OpenCompany\Integrations\Kubernetes\Tools;

/**
 * Get apps apigroup.
 *
 * Maps to the official Kubernetes endpoint get /apis/apps/.
 */
class KubernetesGetAppsApigroup extends AbstractKubernetesTool
{
    protected const NAME = 'kubernetes_get_apps_apigroup';
    protected const DESCRIPTION = 'Get apps apigroup

Official Kubernetes endpoint: GET /apis/apps/

get information of a group';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/apis/apps/';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
