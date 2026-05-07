<?php

namespace OpenCompany\Integrations\Kubernetes\Tools;

/**
 * Read storagemigration v 1 beta 1 storage version migration status.
 *
 * Maps to the official Kubernetes endpoint get /apis/storagemigration.k8s.io/v1beta1/storageversionmigrations/{name}/status.
 */
class KubernetesReadStoragemigrationV1Beta1StorageVersionMigrationStatus extends AbstractKubernetesTool
{
    protected const NAME = 'kubernetes_read_storagemigration_v1_beta1_storage_version_migration_status';
    protected const DESCRIPTION = 'Read storagemigration v 1 beta 1 storage version migration status

Official Kubernetes endpoint: GET /apis/storagemigration.k8s.io/v1beta1/storageversionmigrations/{name}/status

read status of the specified StorageVersionMigration';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'description' => 'name of the StorageVersionMigration',
    'required' => true,
  ),
  'pretty' =>
  array (
    'type' => 'string',
    'description' => 'If \'true\', then the output is pretty printed. Defaults to \'false\' unless the user-agent indicates a browser or command-line HTTP tool (curl and wget).',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/apis/storagemigration.k8s.io/v1beta1/storageversionmigrations/{name}/status';
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
