<?php

namespace OpenCompany\Integrations\Kubernetes\Tools;

/**
 * Read storage v 1 beta 1 volume attributes class.
 *
 * Maps to the official Kubernetes endpoint get /apis/storage.k8s.io/v1beta1/volumeattributesclasses/{name}.
 */
class KubernetesReadStorageV1Beta1VolumeAttributesClass extends AbstractKubernetesTool
{
    protected const NAME = 'kubernetes_read_storage_v1_beta1_volume_attributes_class';
    protected const DESCRIPTION = 'Read storage v 1 beta 1 volume attributes class

Official Kubernetes endpoint: GET /apis/storage.k8s.io/v1beta1/volumeattributesclasses/{name}

read the specified VolumeAttributesClass';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'description' => 'name of the VolumeAttributesClass',
    'required' => true,
  ),
  'pretty' =>
  array (
    'type' => 'string',
    'description' => 'If \'true\', then the output is pretty printed. Defaults to \'false\' unless the user-agent indicates a browser or command-line HTTP tool (curl and wget).',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/apis/storage.k8s.io/v1beta1/volumeattributesclasses/{name}';
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
