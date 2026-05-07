<?php

namespace OpenCompany\Integrations\Kubernetes\Tools;

/**
 * Delete admissionregistration v 1 mutating admission policy binding.
 *
 * Maps to the official Kubernetes endpoint delete /apis/admissionregistration.k8s.io/v1/mutatingadmissionpolicybindings/{name}.
 */
class KubernetesDeleteAdmissionregistrationV1MutatingAdmissionPolicyBinding extends AbstractKubernetesTool
{
    protected const NAME = 'kubernetes_delete_admissionregistration_v1_mutating_admission_policy_binding';
    protected const DESCRIPTION = 'Delete admissionregistration v 1 mutating admission policy binding

Official Kubernetes endpoint: DELETE /apis/admissionregistration.k8s.io/v1/mutatingadmissionpolicybindings/{name}

delete a MutatingAdmissionPolicyBinding';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'description' => 'name of the MutatingAdmissionPolicyBinding',
    'required' => true,
  ),
  'pretty' =>
  array (
    'type' => 'string',
    'description' => 'If \'true\', then the output is pretty printed. Defaults to \'false\' unless the user-agent indicates a browser or command-line HTTP tool (curl and wget).',
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'Kubernetes object body matching the endpoint schema.',
  ),
  'dry_run' =>
  array (
    'type' => 'string',
    'description' => 'When present, indicates that modifications should not be persisted. An invalid or unrecognized dryRun directive will result in an error response and no further processing of the request. Valid values are: - All: all dry run stages will be processed',
  ),
  'grace_period_seconds' =>
  array (
    'type' => 'integer',
    'description' => 'The duration in seconds before the object should be deleted. Value must be non-negative integer. The value zero indicates delete immediately. If this value is nil, the default grace period for the specified type will be used. Defaults to a per object value if not specified. zero means delete immediately.',
  ),
  'ignore_store_read_error_with_cluster_breaking_potential' =>
  array (
    'type' => 'boolean',
    'description' => 'if set to true, it will trigger an unsafe deletion of the resource in case the normal deletion flow fails with a corrupt object error. A resource is considered corrupt if it can not be retrieved from the underlying storage successfully because of a) its data can not be transformed e.g. decryption failure, or b) it fails to decode into an object. NOTE: unsafe deletion ignores finalizer constraints, skips precondition checks, and removes the object from the storage. WARNING: This may potentially break the cluster if the workload associated with the resource being unsafe-deleted relies on normal deletion flow. Use only if you REALLY know what you are doing. The default value is false, and the user must opt in to enable it',
  ),
  'orphan_dependents' =>
  array (
    'type' => 'boolean',
    'description' => 'Deprecated: please use the PropagationPolicy, this field will be deprecated in 1.7. Should the dependent objects be orphaned. If true/false, the "orphan" finalizer will be added to/removed from the object\'s finalizers list. Either this field or PropagationPolicy may be set, but not both.',
  ),
  'propagation_policy' =>
  array (
    'type' => 'string',
    'description' => 'Whether and how garbage collection will be performed. Either this field or OrphanDependents may be set, but not both. The default policy is decided by the existing finalizer set in the metadata.finalizers and the resource-specific default policy. Acceptable values are: \'Orphan\' - orphan the dependents; \'Background\' - allow the garbage collector to delete the dependents in the background; \'Foreground\' - a cascading policy that deletes all dependents in the foreground.',
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/apis/admissionregistration.k8s.io/v1/mutatingadmissionpolicybindings/{name}';
    protected const PATH_PARAMS = array (
  'name' => 'name',
);
    protected const QUERY_PARAMS = array (
  'pretty' => 'pretty',
  'dryRun' => 'dry_run',
  'gracePeriodSeconds' => 'grace_period_seconds',
  'ignoreStoreReadErrorWithClusterBreakingPotential' => 'ignore_store_read_error_with_cluster_breaking_potential',
  'orphanDependents' => 'orphan_dependents',
  'propagationPolicy' => 'propagation_policy',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
