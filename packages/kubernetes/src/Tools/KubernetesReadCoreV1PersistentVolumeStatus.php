<?php

namespace OpenCompany\Integrations\Kubernetes\Tools;

/**
 * Read core v 1 persistent volume status.
 *
 * Maps to the official Kubernetes endpoint get /api/v1/persistentvolumes/{name}/status.
 */
class KubernetesReadCoreV1PersistentVolumeStatus extends AbstractKubernetesTool
{
    protected const NAME = 'kubernetes_read_core_v1_persistent_volume_status';
    protected const DESCRIPTION = 'Read core v 1 persistent volume status

Official Kubernetes endpoint: GET /api/v1/persistentvolumes/{name}/status

read status of the specified PersistentVolume';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'description' => 'name of the PersistentVolume',
    'required' => true,
  ),
  'pretty' =>
  array (
    'type' => 'string',
    'description' => 'If \'true\', then the output is pretty printed. Defaults to \'false\' unless the user-agent indicates a browser or command-line HTTP tool (curl and wget).',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/v1/persistentvolumes/{name}/status';
    protected const PATH_PARAMS = array (
  'name' => 'name',
);
    protected const QUERY_PARAMS = array (
  'pretty' => 'pretty',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
