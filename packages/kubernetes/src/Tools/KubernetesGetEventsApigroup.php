<?php

namespace OpenCompany\Integrations\Kubernetes\Tools;

/**
 * Get events apigroup.
 *
 * Maps to the official Kubernetes endpoint get /apis/events.k8s.io/.
 */
class KubernetesGetEventsApigroup extends AbstractKubernetesTool
{
    protected const NAME = 'kubernetes_get_events_apigroup';
    protected const DESCRIPTION = 'Get events apigroup

Official Kubernetes endpoint: GET /apis/events.k8s.io/

get information of a group';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/apis/events.k8s.io/';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
