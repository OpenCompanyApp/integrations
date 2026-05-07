<?php

namespace OpenCompany\Integrations\Kubernetes\Tools;

/**
 * Read storage v 1 volume attachment status.
 *
 * Maps to the official Kubernetes endpoint get /apis/storage.k8s.io/v1/volumeattachments/{name}/status.
 */
class KubernetesReadStorageV1VolumeAttachmentStatus extends AbstractKubernetesTool
{
    protected const NAME = 'kubernetes_read_storage_v1_volume_attachment_status';
    protected const DESCRIPTION = 'Read storage v 1 volume attachment status

Official Kubernetes endpoint: GET /apis/storage.k8s.io/v1/volumeattachments/{name}/status

read status of the specified VolumeAttachment';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'description' => 'name of the VolumeAttachment',
    'required' => true,
  ),
  'pretty' =>
  array (
    'type' => 'string',
    'description' => 'If \'true\', then the output is pretty printed. Defaults to \'false\' unless the user-agent indicates a browser or command-line HTTP tool (curl and wget).',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/apis/storage.k8s.io/v1/volumeattachments/{name}/status';
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
