<?php

namespace OpenCompany\Integrations\Kubernetes\Tools;

/**
 * Read core v 1 namespaced persistent volume claim status.
 *
 * Maps to the official Kubernetes endpoint get /api/v1/namespaces/{namespace}/persistentvolumeclaims/{name}/status.
 */
class KubernetesReadCoreV1NamespacedPersistentVolumeClaimStatus extends AbstractKubernetesTool
{
    protected const NAME = 'kubernetes_read_core_v1_namespaced_persistent_volume_claim_status';
    protected const DESCRIPTION = 'Read core v 1 namespaced persistent volume claim status

Official Kubernetes endpoint: GET /api/v1/namespaces/{namespace}/persistentvolumeclaims/{name}/status

read status of the specified PersistentVolumeClaim';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'description' => 'name of the PersistentVolumeClaim',
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
    protected const PATH = '/api/v1/namespaces/{namespace}/persistentvolumeclaims/{name}/status';
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
