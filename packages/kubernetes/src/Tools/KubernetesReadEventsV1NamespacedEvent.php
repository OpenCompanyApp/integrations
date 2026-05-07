<?php

namespace OpenCompany\Integrations\Kubernetes\Tools;

/**
 * Read events v 1 namespaced event.
 *
 * Maps to the official Kubernetes endpoint get /apis/events.k8s.io/v1/namespaces/{namespace}/events/{name}.
 */
class KubernetesReadEventsV1NamespacedEvent extends AbstractKubernetesTool
{
    protected const NAME = 'kubernetes_read_events_v1_namespaced_event';
    protected const DESCRIPTION = 'Read events v 1 namespaced event

Official Kubernetes endpoint: GET /apis/events.k8s.io/v1/namespaces/{namespace}/events/{name}

read the specified Event';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'description' => 'name of the Event',
    'required' => true,
  ),
  'namespace' =>
  array (
    'type' => 'string',
    'description' => 'object name and auth scope, such as for teams and projects',
    'required' => true,
  ),
  'pretty' =>
  array (
    'type' => 'string',
    'description' => 'If \'true\', then the output is pretty printed. Defaults to \'false\' unless the user-agent indicates a browser or command-line HTTP tool (curl and wget).',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/apis/events.k8s.io/v1/namespaces/{namespace}/events/{name}';
    protected const PATH_PARAMS = array (
  'name' => 'name',
  'namespace' => 'namespace',
);
    protected const QUERY_PARAMS = array (
  'pretty' => 'pretty',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
