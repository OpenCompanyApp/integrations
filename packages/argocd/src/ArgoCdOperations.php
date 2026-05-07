<?php

namespace OpenCompany\Integrations\ArgoCd;

/**
 * Generated metadata for official Argo CD Swagger operations.
 *
 * Source: https://raw.githubusercontent.com/argoproj/argo-cd/master/assets/swagger.json
 */
class ArgoCdOperations
{
    /**
     * @return array<string, array<string, mixed>>
     */
    public static function all(): array
    {
        return array (
  'argocd_account_list_accounts' =>
  array (
    'slug' => 'argocd_account_list_accounts',
    'class' => 'ArgoCdAccountListAccounts',
    'method' => 'GET',
    'path' => '/api/v1/account',
    'operation_id' => 'AccountService_ListAccounts',
    'name' => 'ListAccounts returns the list of accounts',
    'description' => 'ListAccounts returns the list of accounts',
    'type' => 'read',
    'auth_required' => true,
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'argocd_account_can_i' =>
  array (
    'slug' => 'argocd_account_can_i',
    'class' => 'ArgoCdAccountCanI',
    'method' => 'GET',
    'path' => '/api/v1/account/can-i/{resource}/{action}/{subresource}',
    'operation_id' => 'AccountService_CanI',
    'name' => 'CanI checks if the current account has permission to perform an action',
    'description' => 'CanI checks if the current account has permission to perform an action',
    'type' => 'read',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'resource',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => '',
      ),
      1 =>
      array (
        'name' => 'action',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => '',
      ),
      2 =>
      array (
        'name' => 'subresource',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => '',
      ),
    ),
    'request_body' => NULL,
  ),
  'argocd_account_update_password' =>
  array (
    'slug' => 'argocd_account_update_password',
    'class' => 'ArgoCdAccountUpdatePassword',
    'method' => 'PUT',
    'path' => '/api/v1/account/password',
    'operation_id' => 'AccountService_UpdatePassword',
    'name' => 'UpdatePassword updates an account\'s password to a new value',
    'description' => 'UpdatePassword updates an account\'s password to a new value',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Request body for the Argo CD API operation.',
    ),
  ),
  'argocd_account_get_account' =>
  array (
    'slug' => 'argocd_account_get_account',
    'class' => 'ArgoCdAccountGetAccount',
    'method' => 'GET',
    'path' => '/api/v1/account/{name}',
    'operation_id' => 'AccountService_GetAccount',
    'name' => 'GetAccount returns an account',
    'description' => 'GetAccount returns an account',
    'type' => 'read',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'name',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => '',
      ),
    ),
    'request_body' => NULL,
  ),
  'argocd_account_create_token' =>
  array (
    'slug' => 'argocd_account_create_token',
    'class' => 'ArgoCdAccountCreateToken',
    'method' => 'POST',
    'path' => '/api/v1/account/{name}/token',
    'operation_id' => 'AccountService_CreateToken',
    'name' => 'CreateToken creates a token',
    'description' => 'CreateToken creates a token',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'name',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => '',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Request body for the Argo CD API operation.',
    ),
  ),
  'argocd_account_delete_token' =>
  array (
    'slug' => 'argocd_account_delete_token',
    'class' => 'ArgoCdAccountDeleteToken',
    'method' => 'DELETE',
    'path' => '/api/v1/account/{name}/token/{id}',
    'operation_id' => 'AccountService_DeleteToken',
    'name' => 'DeleteToken deletes a token',
    'description' => 'DeleteToken deletes a token',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'name',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => '',
      ),
      1 =>
      array (
        'name' => 'id',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => '',
      ),
    ),
    'request_body' => NULL,
  ),
  'argocd_list_applications' =>
  array (
    'slug' => 'argocd_list_applications',
    'class' => 'ArgoCdListApplications',
    'method' => 'GET',
    'path' => '/api/v1/applications',
    'operation_id' => 'ApplicationService_List',
    'name' => 'List returns list of applications',
    'description' => 'List returns list of applications',
    'type' => 'read',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'name',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'the application\'s name.',
      ),
      1 =>
      array (
        'name' => 'refresh',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'forces application reconciliation if set to \'hard\'.',
      ),
      2 =>
      array (
        'name' => 'projects',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'array',
        'description' => 'the project names to restrict returned list applications.',
      ),
      3 =>
      array (
        'name' => 'resourceVersion',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'when specified with a watch call, shows changes that occur after that particular version of a resource.',
      ),
      4 =>
      array (
        'name' => 'selector',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'the selector to restrict returned list to applications only with matched labels.',
      ),
      5 =>
      array (
        'name' => 'repo',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'the repoURL to restrict returned list applications.',
      ),
      6 =>
      array (
        'name' => 'appNamespace',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'the application\'s namespace.',
      ),
      7 =>
      array (
        'name' => 'project',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'array',
        'description' => 'the project names to restrict returned list applications legacy name for backwards-compatibility.',
      ),
    ),
    'request_body' => NULL,
  ),
  'argocd_create_application' =>
  array (
    'slug' => 'argocd_create_application',
    'class' => 'ArgoCdCreateApplication',
    'method' => 'POST',
    'path' => '/api/v1/applications',
    'operation_id' => 'ApplicationService_Create',
    'name' => 'Create creates an application',
    'description' => 'Create creates an application',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'upsert',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'boolean',
        'description' => '',
      ),
      1 =>
      array (
        'name' => 'validate',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'boolean',
        'description' => '',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Request body for the Argo CD API operation.',
    ),
  ),
  'argocd_application_get_manifests_with_files' =>
  array (
    'slug' => 'argocd_application_get_manifests_with_files',
    'class' => 'ArgoCdApplicationGetManifestsWithFiles',
    'method' => 'POST',
    'path' => '/api/v1/applications/manifestsWithFiles',
    'operation_id' => 'ApplicationService_GetManifestsWithFiles',
    'name' => 'GetManifestsWithFiles returns application manifests using provided files to generate them',
    'description' => 'GetManifestsWithFiles returns application manifests using provided files to generate them',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'streaming inputs',
    ),
  ),
  'argocd_application_server_side_diff' =>
  array (
    'slug' => 'argocd_application_server_side_diff',
    'class' => 'ArgoCdApplicationServerSideDiff',
    'method' => 'GET',
    'path' => '/api/v1/applications/{appName}/server-side-diff',
    'operation_id' => 'ApplicationService_ServerSideDiff',
    'name' => 'ServerSideDiff performs server-side diff calculation using dry-run apply',
    'description' => 'ServerSideDiff performs server-side diff calculation using dry-run apply',
    'type' => 'read',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'appName',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => '',
      ),
      1 =>
      array (
        'name' => 'appNamespace',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
      2 =>
      array (
        'name' => 'project',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
      3 =>
      array (
        'name' => 'targetManifests',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'array',
        'description' => '',
      ),
    ),
    'request_body' => NULL,
  ),
  'argocd_application_update' =>
  array (
    'slug' => 'argocd_application_update',
    'class' => 'ArgoCdApplicationUpdate',
    'method' => 'PUT',
    'path' => '/api/v1/applications/{application.metadata.name}',
    'operation_id' => 'ApplicationService_Update',
    'name' => 'Update updates an application',
    'description' => 'Update updates an application',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'application.metadata.name',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'Name must be unique within a namespace. Is required when creating resources, although some resources may allow a client to request the generation of an appropriate name automatically. Name is primarily intended for creation idempotence and configuration definition. Cannot be updated. More info: https://kubernetes.io/docs/concepts/overview/working-with-objects/namesnames +optional',
      ),
      1 =>
      array (
        'name' => 'validate',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'boolean',
        'description' => '',
      ),
      2 =>
      array (
        'name' => 'project',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Request body for the Argo CD API operation.',
    ),
  ),
  'argocd_application_managed_resources' =>
  array (
    'slug' => 'argocd_application_managed_resources',
    'class' => 'ArgoCdApplicationManagedResources',
    'method' => 'GET',
    'path' => '/api/v1/applications/{applicationName}/managed-resources',
    'operation_id' => 'ApplicationService_ManagedResources',
    'name' => 'ManagedResources returns list of managed resources',
    'description' => 'ManagedResources returns list of managed resources',
    'type' => 'read',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'applicationName',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => '',
      ),
      1 =>
      array (
        'name' => 'namespace',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
      2 =>
      array (
        'name' => 'name',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
      3 =>
      array (
        'name' => 'version',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
      4 =>
      array (
        'name' => 'group',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
      5 =>
      array (
        'name' => 'kind',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
      6 =>
      array (
        'name' => 'appNamespace',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
      7 =>
      array (
        'name' => 'project',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
    ),
    'request_body' => NULL,
  ),
  'argocd_application_resource_tree' =>
  array (
    'slug' => 'argocd_application_resource_tree',
    'class' => 'ArgoCdApplicationResourceTree',
    'method' => 'GET',
    'path' => '/api/v1/applications/{applicationName}/resource-tree',
    'operation_id' => 'ApplicationService_ResourceTree',
    'name' => 'ResourceTree returns resource tree',
    'description' => 'ResourceTree returns resource tree',
    'type' => 'read',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'applicationName',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => '',
      ),
      1 =>
      array (
        'name' => 'namespace',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
      2 =>
      array (
        'name' => 'name',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
      3 =>
      array (
        'name' => 'version',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
      4 =>
      array (
        'name' => 'group',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
      5 =>
      array (
        'name' => 'kind',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
      6 =>
      array (
        'name' => 'appNamespace',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
      7 =>
      array (
        'name' => 'project',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
    ),
    'request_body' => NULL,
  ),
  'argocd_get_application' =>
  array (
    'slug' => 'argocd_get_application',
    'class' => 'ArgoCdGetApplication',
    'method' => 'GET',
    'path' => '/api/v1/applications/{name}',
    'operation_id' => 'ApplicationService_Get',
    'name' => 'Get returns an application by name',
    'description' => 'Get returns an application by name',
    'type' => 'read',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'name',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'the application\'s name',
      ),
      1 =>
      array (
        'name' => 'refresh',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'forces application reconciliation if set to \'hard\'.',
      ),
      2 =>
      array (
        'name' => 'projects',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'array',
        'description' => 'the project names to restrict returned list applications.',
      ),
      3 =>
      array (
        'name' => 'resourceVersion',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'when specified with a watch call, shows changes that occur after that particular version of a resource.',
      ),
      4 =>
      array (
        'name' => 'selector',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'the selector to restrict returned list to applications only with matched labels.',
      ),
      5 =>
      array (
        'name' => 'repo',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'the repoURL to restrict returned list applications.',
      ),
      6 =>
      array (
        'name' => 'appNamespace',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'the application\'s namespace.',
      ),
      7 =>
      array (
        'name' => 'project',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'array',
        'description' => 'the project names to restrict returned list applications legacy name for backwards-compatibility.',
      ),
    ),
    'request_body' => NULL,
  ),
  'argocd_application_delete' =>
  array (
    'slug' => 'argocd_application_delete',
    'class' => 'ArgoCdApplicationDelete',
    'method' => 'DELETE',
    'path' => '/api/v1/applications/{name}',
    'operation_id' => 'ApplicationService_Delete',
    'name' => 'Delete deletes an application',
    'description' => 'Delete deletes an application',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'name',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => '',
      ),
      1 =>
      array (
        'name' => 'cascade',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'boolean',
        'description' => '',
      ),
      2 =>
      array (
        'name' => 'propagationPolicy',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
      3 =>
      array (
        'name' => 'appNamespace',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
      4 =>
      array (
        'name' => 'project',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
    ),
    'request_body' => NULL,
  ),
  'argocd_application_patch' =>
  array (
    'slug' => 'argocd_application_patch',
    'class' => 'ArgoCdApplicationPatch',
    'method' => 'PATCH',
    'path' => '/api/v1/applications/{name}',
    'operation_id' => 'ApplicationService_Patch',
    'name' => 'Patch patch an application',
    'description' => 'Patch patch an application',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'name',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => '',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Request body for the Argo CD API operation.',
    ),
  ),
  'argocd_application_list_resource_events' =>
  array (
    'slug' => 'argocd_application_list_resource_events',
    'class' => 'ArgoCdApplicationListResourceEvents',
    'method' => 'GET',
    'path' => '/api/v1/applications/{name}/events',
    'operation_id' => 'ApplicationService_ListResourceEvents',
    'name' => 'ListResourceEvents returns a list of event resources',
    'description' => 'ListResourceEvents returns a list of event resources',
    'type' => 'read',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'name',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => '',
      ),
      1 =>
      array (
        'name' => 'resourceNamespace',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
      2 =>
      array (
        'name' => 'resourceName',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
      3 =>
      array (
        'name' => 'resourceUID',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
      4 =>
      array (
        'name' => 'appNamespace',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
      5 =>
      array (
        'name' => 'project',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
    ),
    'request_body' => NULL,
  ),
  'argocd_application_list_links' =>
  array (
    'slug' => 'argocd_application_list_links',
    'class' => 'ArgoCdApplicationListLinks',
    'method' => 'GET',
    'path' => '/api/v1/applications/{name}/links',
    'operation_id' => 'ApplicationService_ListLinks',
    'name' => 'ListLinks returns the list of all application deep links',
    'description' => 'ListLinks returns the list of all application deep links',
    'type' => 'read',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'name',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => '',
      ),
      1 =>
      array (
        'name' => 'namespace',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
      2 =>
      array (
        'name' => 'project',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
    ),
    'request_body' => NULL,
  ),
  'argocd_application_pod_logs2' =>
  array (
    'slug' => 'argocd_application_pod_logs2',
    'class' => 'ArgoCdApplicationPodLogs2',
    'method' => 'GET',
    'path' => '/api/v1/applications/{name}/logs',
    'operation_id' => 'ApplicationService_PodLogs2',
    'name' => 'PodLogs returns stream of log entries for the specified pod. Pod',
    'description' => 'PodLogs returns stream of log entries for the specified pod. Pod',
    'type' => 'read',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'name',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => '',
      ),
      1 =>
      array (
        'name' => 'namespace',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
      2 =>
      array (
        'name' => 'podName',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
      3 =>
      array (
        'name' => 'container',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
      4 =>
      array (
        'name' => 'sinceSeconds',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
      5 =>
      array (
        'name' => 'sinceTime.seconds',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Represents seconds of UTC time since Unix epoch 1970-01-01T00:00:00Z. Must be from 0001-01-01T00:00:00Z to 9999-12-31T23:59:59Z inclusive.',
      ),
      6 =>
      array (
        'name' => 'sinceTime.nanos',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'Non-negative fractions of a second at nanosecond resolution. Negative second values with fractions must still have non-negative nanos values that count forward in time. Must be from 0 to 999,999,999 inclusive. This field may be limited in precision depending on context.',
      ),
      7 =>
      array (
        'name' => 'tailLines',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
      8 =>
      array (
        'name' => 'follow',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'boolean',
        'description' => '',
      ),
      9 =>
      array (
        'name' => 'untilTime',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
      10 =>
      array (
        'name' => 'filter',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
      11 =>
      array (
        'name' => 'kind',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
      12 =>
      array (
        'name' => 'group',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
      13 =>
      array (
        'name' => 'resourceName',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
      14 =>
      array (
        'name' => 'previous',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'boolean',
        'description' => '',
      ),
      15 =>
      array (
        'name' => 'appNamespace',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
      16 =>
      array (
        'name' => 'project',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
      17 =>
      array (
        'name' => 'matchCase',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'boolean',
        'description' => '',
      ),
    ),
    'request_body' => NULL,
  ),
  'argocd_application_get_manifests' =>
  array (
    'slug' => 'argocd_application_get_manifests',
    'class' => 'ArgoCdApplicationGetManifests',
    'method' => 'GET',
    'path' => '/api/v1/applications/{name}/manifests',
    'operation_id' => 'ApplicationService_GetManifests',
    'name' => 'GetManifests returns application manifests',
    'description' => 'GetManifests returns application manifests',
    'type' => 'read',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'name',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => '',
      ),
      1 =>
      array (
        'name' => 'revision',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
      2 =>
      array (
        'name' => 'appNamespace',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
      3 =>
      array (
        'name' => 'project',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
      4 =>
      array (
        'name' => 'sourcePositions',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'array',
        'description' => '',
      ),
      5 =>
      array (
        'name' => 'revisions',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'array',
        'description' => '',
      ),
      6 =>
      array (
        'name' => 'noCache',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'boolean',
        'description' => '',
      ),
    ),
    'request_body' => NULL,
  ),
  'argocd_application_terminate_operation' =>
  array (
    'slug' => 'argocd_application_terminate_operation',
    'class' => 'ArgoCdApplicationTerminateOperation',
    'method' => 'DELETE',
    'path' => '/api/v1/applications/{name}/operation',
    'operation_id' => 'ApplicationService_TerminateOperation',
    'name' => 'TerminateOperation terminates the currently running operation',
    'description' => 'TerminateOperation terminates the currently running operation',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'name',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => '',
      ),
      1 =>
      array (
        'name' => 'appNamespace',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
      2 =>
      array (
        'name' => 'project',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
    ),
    'request_body' => NULL,
  ),
  'argocd_application_pod_logs' =>
  array (
    'slug' => 'argocd_application_pod_logs',
    'class' => 'ArgoCdApplicationPodLogs',
    'method' => 'GET',
    'path' => '/api/v1/applications/{name}/pods/{podName}/logs',
    'operation_id' => 'ApplicationService_PodLogs',
    'name' => 'PodLogs returns stream of log entries for the specified pod. Pod',
    'description' => 'PodLogs returns stream of log entries for the specified pod. Pod',
    'type' => 'read',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'name',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => '',
      ),
      1 =>
      array (
        'name' => 'podName',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => '',
      ),
      2 =>
      array (
        'name' => 'namespace',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
      3 =>
      array (
        'name' => 'container',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
      4 =>
      array (
        'name' => 'sinceSeconds',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
      5 =>
      array (
        'name' => 'sinceTime.seconds',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Represents seconds of UTC time since Unix epoch 1970-01-01T00:00:00Z. Must be from 0001-01-01T00:00:00Z to 9999-12-31T23:59:59Z inclusive.',
      ),
      6 =>
      array (
        'name' => 'sinceTime.nanos',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'Non-negative fractions of a second at nanosecond resolution. Negative second values with fractions must still have non-negative nanos values that count forward in time. Must be from 0 to 999,999,999 inclusive. This field may be limited in precision depending on context.',
      ),
      7 =>
      array (
        'name' => 'tailLines',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
      8 =>
      array (
        'name' => 'follow',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'boolean',
        'description' => '',
      ),
      9 =>
      array (
        'name' => 'untilTime',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
      10 =>
      array (
        'name' => 'filter',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
      11 =>
      array (
        'name' => 'kind',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
      12 =>
      array (
        'name' => 'group',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
      13 =>
      array (
        'name' => 'resourceName',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
      14 =>
      array (
        'name' => 'previous',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'boolean',
        'description' => '',
      ),
      15 =>
      array (
        'name' => 'appNamespace',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
      16 =>
      array (
        'name' => 'project',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
      17 =>
      array (
        'name' => 'matchCase',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'boolean',
        'description' => '',
      ),
    ),
    'request_body' => NULL,
  ),
  'argocd_application_get_resource' =>
  array (
    'slug' => 'argocd_application_get_resource',
    'class' => 'ArgoCdApplicationGetResource',
    'method' => 'GET',
    'path' => '/api/v1/applications/{name}/resource',
    'operation_id' => 'ApplicationService_GetResource',
    'name' => 'GetResource returns single application resource',
    'description' => 'GetResource returns single application resource',
    'type' => 'read',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'name',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => '',
      ),
      1 =>
      array (
        'name' => 'namespace',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
      2 =>
      array (
        'name' => 'resourceName',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
      3 =>
      array (
        'name' => 'version',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
      4 =>
      array (
        'name' => 'group',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
      5 =>
      array (
        'name' => 'kind',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
      6 =>
      array (
        'name' => 'appNamespace',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
      7 =>
      array (
        'name' => 'project',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
    ),
    'request_body' => NULL,
  ),
  'argocd_application_patch_resource' =>
  array (
    'slug' => 'argocd_application_patch_resource',
    'class' => 'ArgoCdApplicationPatchResource',
    'method' => 'POST',
    'path' => '/api/v1/applications/{name}/resource',
    'operation_id' => 'ApplicationService_PatchResource',
    'name' => 'PatchResource patch single application resource',
    'description' => 'PatchResource patch single application resource',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'name',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => '',
      ),
      1 =>
      array (
        'name' => 'namespace',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
      2 =>
      array (
        'name' => 'resourceName',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
      3 =>
      array (
        'name' => 'version',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
      4 =>
      array (
        'name' => 'group',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
      5 =>
      array (
        'name' => 'kind',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
      6 =>
      array (
        'name' => 'patchType',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
      7 =>
      array (
        'name' => 'appNamespace',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
      8 =>
      array (
        'name' => 'project',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'string',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Request body for the Argo CD API operation.',
    ),
  ),
  'argocd_application_delete_resource' =>
  array (
    'slug' => 'argocd_application_delete_resource',
    'class' => 'ArgoCdApplicationDeleteResource',
    'method' => 'DELETE',
    'path' => '/api/v1/applications/{name}/resource',
    'operation_id' => 'ApplicationService_DeleteResource',
    'name' => 'DeleteResource deletes a single application resource',
    'description' => 'DeleteResource deletes a single application resource',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'name',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => '',
      ),
      1 =>
      array (
        'name' => 'namespace',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
      2 =>
      array (
        'name' => 'resourceName',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
      3 =>
      array (
        'name' => 'version',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
      4 =>
      array (
        'name' => 'group',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
      5 =>
      array (
        'name' => 'kind',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
      6 =>
      array (
        'name' => 'force',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'boolean',
        'description' => '',
      ),
      7 =>
      array (
        'name' => 'orphan',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'boolean',
        'description' => '',
      ),
      8 =>
      array (
        'name' => 'appNamespace',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
      9 =>
      array (
        'name' => 'project',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
    ),
    'request_body' => NULL,
  ),
  'argocd_application_list_resource_actions' =>
  array (
    'slug' => 'argocd_application_list_resource_actions',
    'class' => 'ArgoCdApplicationListResourceActions',
    'method' => 'GET',
    'path' => '/api/v1/applications/{name}/resource/actions',
    'operation_id' => 'ApplicationService_ListResourceActions',
    'name' => 'ListResourceActions returns list of resource actions',
    'description' => 'ListResourceActions returns list of resource actions',
    'type' => 'read',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'name',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => '',
      ),
      1 =>
      array (
        'name' => 'namespace',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
      2 =>
      array (
        'name' => 'resourceName',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
      3 =>
      array (
        'name' => 'version',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
      4 =>
      array (
        'name' => 'group',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
      5 =>
      array (
        'name' => 'kind',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
      6 =>
      array (
        'name' => 'appNamespace',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
      7 =>
      array (
        'name' => 'project',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
    ),
    'request_body' => NULL,
  ),
  'argocd_application_run_resource_action' =>
  array (
    'slug' => 'argocd_application_run_resource_action',
    'class' => 'ArgoCdApplicationRunResourceAction',
    'method' => 'POST',
    'path' => '/api/v1/applications/{name}/resource/actions',
    'operation_id' => 'ApplicationService_RunResourceAction',
    'name' => 'RunResourceAction runs a resource action',
    'description' => 'Deprecated: use RunResourceActionV2 instead. This version does not support resource action parameters but is maintained for backward compatibility. It will be removed in a future release.',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'name',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => '',
      ),
      1 =>
      array (
        'name' => 'namespace',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
      2 =>
      array (
        'name' => 'resourceName',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
      3 =>
      array (
        'name' => 'version',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
      4 =>
      array (
        'name' => 'group',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
      5 =>
      array (
        'name' => 'kind',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
      6 =>
      array (
        'name' => 'appNamespace',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
      7 =>
      array (
        'name' => 'project',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'string',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Request body for the Argo CD API operation.',
    ),
  ),
  'argocd_application_run_resource_action_v2' =>
  array (
    'slug' => 'argocd_application_run_resource_action_v2',
    'class' => 'ArgoCdApplicationRunResourceActionV2',
    'method' => 'POST',
    'path' => '/api/v1/applications/{name}/resource/actions/v2',
    'operation_id' => 'ApplicationService_RunResourceActionV2',
    'name' => 'RunResourceActionV2 runs a resource action with parameters',
    'description' => 'RunResourceActionV2 runs a resource action with parameters',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'name',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => '',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Request body for the Argo CD API operation.',
    ),
  ),
  'argocd_application_list_resource_links' =>
  array (
    'slug' => 'argocd_application_list_resource_links',
    'class' => 'ArgoCdApplicationListResourceLinks',
    'method' => 'GET',
    'path' => '/api/v1/applications/{name}/resource/links',
    'operation_id' => 'ApplicationService_ListResourceLinks',
    'name' => 'ListResourceLinks returns the list of all resource deep links',
    'description' => 'ListResourceLinks returns the list of all resource deep links',
    'type' => 'read',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'name',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => '',
      ),
      1 =>
      array (
        'name' => 'namespace',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
      2 =>
      array (
        'name' => 'resourceName',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
      3 =>
      array (
        'name' => 'version',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
      4 =>
      array (
        'name' => 'group',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
      5 =>
      array (
        'name' => 'kind',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
      6 =>
      array (
        'name' => 'appNamespace',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
      7 =>
      array (
        'name' => 'project',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
    ),
    'request_body' => NULL,
  ),
  'argocd_application_revision_chart_details' =>
  array (
    'slug' => 'argocd_application_revision_chart_details',
    'class' => 'ArgoCdApplicationRevisionChartDetails',
    'method' => 'GET',
    'path' => '/api/v1/applications/{name}/revisions/{revision}/chartdetails',
    'operation_id' => 'ApplicationService_RevisionChartDetails',
    'name' => 'Get the chart metadata description, maintainers, home for a specific revision of the application',
    'description' => 'Get the chart metadata description, maintainers, home for a specific revision of the application',
    'type' => 'read',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'name',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'the application\'s name',
      ),
      1 =>
      array (
        'name' => 'revision',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'the revision of the app',
      ),
      2 =>
      array (
        'name' => 'appNamespace',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'the application\'s namespace.',
      ),
      3 =>
      array (
        'name' => 'project',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
      4 =>
      array (
        'name' => 'sourceIndex',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'source index for multi source apps.',
      ),
      5 =>
      array (
        'name' => 'versionId',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'versionId from historical data for multi source apps.',
      ),
    ),
    'request_body' => NULL,
  ),
  'argocd_application_revision_metadata' =>
  array (
    'slug' => 'argocd_application_revision_metadata',
    'class' => 'ArgoCdApplicationRevisionMetadata',
    'method' => 'GET',
    'path' => '/api/v1/applications/{name}/revisions/{revision}/metadata',
    'operation_id' => 'ApplicationService_RevisionMetadata',
    'name' => 'Get the meta-data author, date, tags, message for a specific revision of the application',
    'description' => 'Get the meta-data author, date, tags, message for a specific revision of the application',
    'type' => 'read',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'name',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'the application\'s name',
      ),
      1 =>
      array (
        'name' => 'revision',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'the revision of the app',
      ),
      2 =>
      array (
        'name' => 'appNamespace',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'the application\'s namespace.',
      ),
      3 =>
      array (
        'name' => 'project',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
      4 =>
      array (
        'name' => 'sourceIndex',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'source index for multi source apps.',
      ),
      5 =>
      array (
        'name' => 'versionId',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'versionId from historical data for multi source apps.',
      ),
    ),
    'request_body' => NULL,
  ),
  'argocd_application_get_o_c_i_metadata' =>
  array (
    'slug' => 'argocd_application_get_o_c_i_metadata',
    'class' => 'ArgoCdApplicationGetOCIMetadata',
    'method' => 'GET',
    'path' => '/api/v1/applications/{name}/revisions/{revision}/ocimetadata',
    'operation_id' => 'ApplicationService_GetOCIMetadata',
    'name' => 'Get the chart metadata description, maintainers, home for a specific revision of the application',
    'description' => 'Get the chart metadata description, maintainers, home for a specific revision of the application',
    'type' => 'read',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'name',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'the application\'s name',
      ),
      1 =>
      array (
        'name' => 'revision',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'the revision of the app',
      ),
      2 =>
      array (
        'name' => 'appNamespace',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'the application\'s namespace.',
      ),
      3 =>
      array (
        'name' => 'project',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
      4 =>
      array (
        'name' => 'sourceIndex',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'source index for multi source apps.',
      ),
      5 =>
      array (
        'name' => 'versionId',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'integer',
        'description' => 'versionId from historical data for multi source apps.',
      ),
    ),
    'request_body' => NULL,
  ),
  'argocd_application_rollback' =>
  array (
    'slug' => 'argocd_application_rollback',
    'class' => 'ArgoCdApplicationRollback',
    'method' => 'POST',
    'path' => '/api/v1/applications/{name}/rollback',
    'operation_id' => 'ApplicationService_Rollback',
    'name' => 'Rollback syncs an application to its target state',
    'description' => 'Rollback syncs an application to its target state',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'name',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => '',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Request body for the Argo CD API operation.',
    ),
  ),
  'argocd_application_update_spec' =>
  array (
    'slug' => 'argocd_application_update_spec',
    'class' => 'ArgoCdApplicationUpdateSpec',
    'method' => 'PUT',
    'path' => '/api/v1/applications/{name}/spec',
    'operation_id' => 'ApplicationService_UpdateSpec',
    'name' => 'UpdateSpec updates an application spec',
    'description' => 'UpdateSpec updates an application spec',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'name',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => '',
      ),
      1 =>
      array (
        'name' => 'validate',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'boolean',
        'description' => '',
      ),
      2 =>
      array (
        'name' => 'appNamespace',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
      3 =>
      array (
        'name' => 'project',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Request body for the Argo CD API operation.',
    ),
  ),
  'argocd_application_sync' =>
  array (
    'slug' => 'argocd_application_sync',
    'class' => 'ArgoCdApplicationSync',
    'method' => 'POST',
    'path' => '/api/v1/applications/{name}/sync',
    'operation_id' => 'ApplicationService_Sync',
    'name' => 'Sync syncs an application to its target state',
    'description' => 'Sync syncs an application to its target state',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'name',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => '',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Request body for the Argo CD API operation.',
    ),
  ),
  'argocd_application_get_application_sync_windows' =>
  array (
    'slug' => 'argocd_application_get_application_sync_windows',
    'class' => 'ArgoCdApplicationGetApplicationSyncWindows',
    'method' => 'GET',
    'path' => '/api/v1/applications/{name}/syncwindows',
    'operation_id' => 'ApplicationService_GetApplicationSyncWindows',
    'name' => 'Get returns sync windows of the application',
    'description' => 'Get returns sync windows of the application',
    'type' => 'read',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'name',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => '',
      ),
      1 =>
      array (
        'name' => 'appNamespace',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
      2 =>
      array (
        'name' => 'project',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
    ),
    'request_body' => NULL,
  ),
  'argocd_application_set_list' =>
  array (
    'slug' => 'argocd_application_set_list',
    'class' => 'ArgoCdApplicationSetList',
    'method' => 'GET',
    'path' => '/api/v1/applicationsets',
    'operation_id' => 'ApplicationSetService_List',
    'name' => 'List returns list of applicationset',
    'description' => 'List returns list of applicationset',
    'type' => 'read',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'projects',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'array',
        'description' => 'the project names to restrict returned list applicationsets.',
      ),
      1 =>
      array (
        'name' => 'selector',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'the selector to restrict returned list to applications only with matched labels.',
      ),
      2 =>
      array (
        'name' => 'appsetNamespace',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'The application set namespace. Default empty is argocd control plane namespace.',
      ),
    ),
    'request_body' => NULL,
  ),
  'argocd_application_set_create' =>
  array (
    'slug' => 'argocd_application_set_create',
    'class' => 'ArgoCdApplicationSetCreate',
    'method' => 'POST',
    'path' => '/api/v1/applicationsets',
    'operation_id' => 'ApplicationSetService_Create',
    'name' => 'Create creates an applicationset',
    'description' => 'Create creates an applicationset',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'upsert',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'boolean',
        'description' => '',
      ),
      1 =>
      array (
        'name' => 'dryRun',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'boolean',
        'description' => '',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Request body for the Argo CD API operation.',
    ),
  ),
  'argocd_application_set_generate' =>
  array (
    'slug' => 'argocd_application_set_generate',
    'class' => 'ArgoCdApplicationSetGenerate',
    'method' => 'POST',
    'path' => '/api/v1/applicationsets/generate',
    'operation_id' => 'ApplicationSetService_Generate',
    'name' => 'Generate generates',
    'description' => 'Generate generates',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Request body for the Argo CD API operation.',
    ),
  ),
  'argocd_application_set_get' =>
  array (
    'slug' => 'argocd_application_set_get',
    'class' => 'ArgoCdApplicationSetGet',
    'method' => 'GET',
    'path' => '/api/v1/applicationsets/{name}',
    'operation_id' => 'ApplicationSetService_Get',
    'name' => 'Get returns an applicationset by name',
    'description' => 'Get returns an applicationset by name',
    'type' => 'read',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'name',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'the applicationsets\'s name',
      ),
      1 =>
      array (
        'name' => 'appsetNamespace',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'The application set namespace. Default empty is argocd control plane namespace.',
      ),
    ),
    'request_body' => NULL,
  ),
  'argocd_application_set_delete' =>
  array (
    'slug' => 'argocd_application_set_delete',
    'class' => 'ArgoCdApplicationSetDelete',
    'method' => 'DELETE',
    'path' => '/api/v1/applicationsets/{name}',
    'operation_id' => 'ApplicationSetService_Delete',
    'name' => 'Delete deletes an application set',
    'description' => 'Delete deletes an application set',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'name',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => '',
      ),
      1 =>
      array (
        'name' => 'appsetNamespace',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'The application set namespace. Default empty is argocd control plane namespace.',
      ),
    ),
    'request_body' => NULL,
  ),
  'argocd_application_set_list_resource_events' =>
  array (
    'slug' => 'argocd_application_set_list_resource_events',
    'class' => 'ArgoCdApplicationSetListResourceEvents',
    'method' => 'GET',
    'path' => '/api/v1/applicationsets/{name}/events',
    'operation_id' => 'ApplicationSetService_ListResourceEvents',
    'name' => 'ListResourceEvents returns a list of event resources',
    'description' => 'ListResourceEvents returns a list of event resources',
    'type' => 'read',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'name',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'the applicationsets\'s name',
      ),
      1 =>
      array (
        'name' => 'appsetNamespace',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'The application set namespace. Default empty is argocd control plane namespace.',
      ),
    ),
    'request_body' => NULL,
  ),
  'argocd_application_set_resource_tree' =>
  array (
    'slug' => 'argocd_application_set_resource_tree',
    'class' => 'ArgoCdApplicationSetResourceTree',
    'method' => 'GET',
    'path' => '/api/v1/applicationsets/{name}/resource-tree',
    'operation_id' => 'ApplicationSetService_ResourceTree',
    'name' => 'ResourceTree returns resource tree',
    'description' => 'ResourceTree returns resource tree',
    'type' => 'read',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'name',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => '',
      ),
      1 =>
      array (
        'name' => 'appsetNamespace',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'The application set namespace. Default empty is argocd control plane namespace.',
      ),
    ),
    'request_body' => NULL,
  ),
  'argocd_certificate_list_certificates' =>
  array (
    'slug' => 'argocd_certificate_list_certificates',
    'class' => 'ArgoCdCertificateListCertificates',
    'method' => 'GET',
    'path' => '/api/v1/certificates',
    'operation_id' => 'CertificateService_ListCertificates',
    'name' => 'List all available repository certificates',
    'description' => 'List all available repository certificates',
    'type' => 'read',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'hostNamePattern',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'A file-glob pattern not regular expression the host name has to match.',
      ),
      1 =>
      array (
        'name' => 'certType',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'The type of the certificate to match ssh or https.',
      ),
      2 =>
      array (
        'name' => 'certSubType',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'The sub type of the certificate to match protocol dependent, usually only used for ssh certs.',
      ),
    ),
    'request_body' => NULL,
  ),
  'argocd_certificate_create_certificate' =>
  array (
    'slug' => 'argocd_certificate_create_certificate',
    'class' => 'ArgoCdCertificateCreateCertificate',
    'method' => 'POST',
    'path' => '/api/v1/certificates',
    'operation_id' => 'CertificateService_CreateCertificate',
    'name' => 'Creates repository certificates on the server',
    'description' => 'Creates repository certificates on the server',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'upsert',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'boolean',
        'description' => 'Whether to upsert already existing certificates.',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'List of certificates to be created',
    ),
  ),
  'argocd_certificate_delete_certificate' =>
  array (
    'slug' => 'argocd_certificate_delete_certificate',
    'class' => 'ArgoCdCertificateDeleteCertificate',
    'method' => 'DELETE',
    'path' => '/api/v1/certificates',
    'operation_id' => 'CertificateService_DeleteCertificate',
    'name' => 'Delete the certificates that match the RepositoryCertificateQuery',
    'description' => 'Delete the certificates that match the RepositoryCertificateQuery',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'hostNamePattern',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'A file-glob pattern not regular expression the host name has to match.',
      ),
      1 =>
      array (
        'name' => 'certType',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'The type of the certificate to match ssh or https.',
      ),
      2 =>
      array (
        'name' => 'certSubType',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'The sub type of the certificate to match protocol dependent, usually only used for ssh certs.',
      ),
    ),
    'request_body' => NULL,
  ),
  'argocd_cluster_list' =>
  array (
    'slug' => 'argocd_cluster_list',
    'class' => 'ArgoCdClusterList',
    'method' => 'GET',
    'path' => '/api/v1/clusters',
    'operation_id' => 'ClusterService_List',
    'name' => 'List returns list of clusters',
    'description' => 'List returns list of clusters',
    'type' => 'read',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'server',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
      1 =>
      array (
        'name' => 'name',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
      2 =>
      array (
        'name' => 'id.type',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'type is the type of the specified cluster identifier "server" - default, "name" .',
      ),
      3 =>
      array (
        'name' => 'id.value',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'value holds the cluster server URL or cluster name.',
      ),
    ),
    'request_body' => NULL,
  ),
  'argocd_cluster_create' =>
  array (
    'slug' => 'argocd_cluster_create',
    'class' => 'ArgoCdClusterCreate',
    'method' => 'POST',
    'path' => '/api/v1/clusters',
    'operation_id' => 'ClusterService_Create',
    'name' => 'Create creates a cluster',
    'description' => 'Create creates a cluster',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'upsert',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'boolean',
        'description' => '',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Request body for the Argo CD API operation.',
    ),
  ),
  'argocd_cluster_get' =>
  array (
    'slug' => 'argocd_cluster_get',
    'class' => 'ArgoCdClusterGet',
    'method' => 'GET',
    'path' => '/api/v1/clusters/{id.value}',
    'operation_id' => 'ClusterService_Get',
    'name' => 'Get returns a cluster by server address',
    'description' => 'Get returns a cluster by server address',
    'type' => 'read',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id.value',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'value holds the cluster server URL or cluster name',
      ),
      1 =>
      array (
        'name' => 'server',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
      2 =>
      array (
        'name' => 'name',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
      3 =>
      array (
        'name' => 'id.type',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'type is the type of the specified cluster identifier "server" - default, "name" .',
      ),
    ),
    'request_body' => NULL,
  ),
  'argocd_cluster_update' =>
  array (
    'slug' => 'argocd_cluster_update',
    'class' => 'ArgoCdClusterUpdate',
    'method' => 'PUT',
    'path' => '/api/v1/clusters/{id.value}',
    'operation_id' => 'ClusterService_Update',
    'name' => 'Update updates a cluster',
    'description' => 'Update updates a cluster',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id.value',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'value holds the cluster server URL or cluster name',
      ),
      1 =>
      array (
        'name' => 'updatedFields',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'array',
        'description' => '',
      ),
      2 =>
      array (
        'name' => 'id.type',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'type is the type of the specified cluster identifier "server" - default, "name" .',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Request body for the Argo CD API operation.',
    ),
  ),
  'argocd_cluster_delete' =>
  array (
    'slug' => 'argocd_cluster_delete',
    'class' => 'ArgoCdClusterDelete',
    'method' => 'DELETE',
    'path' => '/api/v1/clusters/{id.value}',
    'operation_id' => 'ClusterService_Delete',
    'name' => 'Delete deletes a cluster',
    'description' => 'Delete deletes a cluster',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id.value',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'value holds the cluster server URL or cluster name',
      ),
      1 =>
      array (
        'name' => 'server',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
      2 =>
      array (
        'name' => 'name',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
      3 =>
      array (
        'name' => 'id.type',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'type is the type of the specified cluster identifier "server" - default, "name" .',
      ),
    ),
    'request_body' => NULL,
  ),
  'argocd_cluster_invalidate_cache' =>
  array (
    'slug' => 'argocd_cluster_invalidate_cache',
    'class' => 'ArgoCdClusterInvalidateCache',
    'method' => 'POST',
    'path' => '/api/v1/clusters/{id.value}/invalidate-cache',
    'operation_id' => 'ClusterService_InvalidateCache',
    'name' => 'InvalidateCache invalidates cluster cache',
    'description' => 'InvalidateCache invalidates cluster cache',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id.value',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'value holds the cluster server URL or cluster name',
      ),
    ),
    'request_body' => NULL,
  ),
  'argocd_cluster_rotate_auth' =>
  array (
    'slug' => 'argocd_cluster_rotate_auth',
    'class' => 'ArgoCdClusterRotateAuth',
    'method' => 'POST',
    'path' => '/api/v1/clusters/{id.value}/rotate-auth',
    'operation_id' => 'ClusterService_RotateAuth',
    'name' => 'RotateAuth rotates the bearer token used for a cluster',
    'description' => 'RotateAuth rotates the bearer token used for a cluster',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'id.value',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'value holds the cluster server URL or cluster name',
      ),
    ),
    'request_body' => NULL,
  ),
  'argocd_g_p_g_key_list' =>
  array (
    'slug' => 'argocd_g_p_g_key_list',
    'class' => 'ArgoCdGPGKeyList',
    'method' => 'GET',
    'path' => '/api/v1/gpgkeys',
    'operation_id' => 'GPGKeyService_List',
    'name' => 'List all available repository certificates',
    'description' => 'List all available repository certificates',
    'type' => 'read',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'keyID',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'The GPG key ID to query for.',
      ),
    ),
    'request_body' => NULL,
  ),
  'argocd_g_p_g_key_create' =>
  array (
    'slug' => 'argocd_g_p_g_key_create',
    'class' => 'ArgoCdGPGKeyCreate',
    'method' => 'POST',
    'path' => '/api/v1/gpgkeys',
    'operation_id' => 'GPGKeyService_Create',
    'name' => 'Create one or more GPG public keys in the server\'s configuration',
    'description' => 'Create one or more GPG public keys in the server\'s configuration',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'upsert',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'boolean',
        'description' => 'Whether to upsert already existing public keys.',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Raw key data of the GPG keys to create',
    ),
  ),
  'argocd_g_p_g_key_delete' =>
  array (
    'slug' => 'argocd_g_p_g_key_delete',
    'class' => 'ArgoCdGPGKeyDelete',
    'method' => 'DELETE',
    'path' => '/api/v1/gpgkeys',
    'operation_id' => 'GPGKeyService_Delete',
    'name' => 'Delete specified GPG public key from the server\'s configuration',
    'description' => 'Delete specified GPG public key from the server\'s configuration',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'keyID',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'The GPG key ID to query for.',
      ),
    ),
    'request_body' => NULL,
  ),
  'argocd_g_p_g_key_get' =>
  array (
    'slug' => 'argocd_g_p_g_key_get',
    'class' => 'ArgoCdGPGKeyGet',
    'method' => 'GET',
    'path' => '/api/v1/gpgkeys/{keyID}',
    'operation_id' => 'GPGKeyService_Get',
    'name' => 'Get information about specified GPG public key from the server',
    'description' => 'Get information about specified GPG public key from the server',
    'type' => 'read',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'keyID',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The GPG key ID to query for',
      ),
    ),
    'request_body' => NULL,
  ),
  'argocd_notification_list_services' =>
  array (
    'slug' => 'argocd_notification_list_services',
    'class' => 'ArgoCdNotificationListServices',
    'method' => 'GET',
    'path' => '/api/v1/notifications/services',
    'operation_id' => 'NotificationService_ListServices',
    'name' => 'List returns list of services',
    'description' => 'List returns list of services',
    'type' => 'read',
    'auth_required' => true,
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'argocd_notification_list_templates' =>
  array (
    'slug' => 'argocd_notification_list_templates',
    'class' => 'ArgoCdNotificationListTemplates',
    'method' => 'GET',
    'path' => '/api/v1/notifications/templates',
    'operation_id' => 'NotificationService_ListTemplates',
    'name' => 'List returns list of templates',
    'description' => 'List returns list of templates',
    'type' => 'read',
    'auth_required' => true,
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'argocd_notification_list_triggers' =>
  array (
    'slug' => 'argocd_notification_list_triggers',
    'class' => 'ArgoCdNotificationListTriggers',
    'method' => 'GET',
    'path' => '/api/v1/notifications/triggers',
    'operation_id' => 'NotificationService_ListTriggers',
    'name' => 'List returns list of triggers',
    'description' => 'List returns list of triggers',
    'type' => 'read',
    'auth_required' => true,
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'argocd_list_projects' =>
  array (
    'slug' => 'argocd_list_projects',
    'class' => 'ArgoCdListProjects',
    'method' => 'GET',
    'path' => '/api/v1/projects',
    'operation_id' => 'ProjectService_List',
    'name' => 'List returns list of projects',
    'description' => 'List returns list of projects',
    'type' => 'read',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'name',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
    ),
    'request_body' => NULL,
  ),
  'argocd_project_create' =>
  array (
    'slug' => 'argocd_project_create',
    'class' => 'ArgoCdProjectCreate',
    'method' => 'POST',
    'path' => '/api/v1/projects',
    'operation_id' => 'ProjectService_Create',
    'name' => 'Create a new project',
    'description' => 'Create a new project',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Request body for the Argo CD API operation.',
    ),
  ),
  'argocd_get_project' =>
  array (
    'slug' => 'argocd_get_project',
    'class' => 'ArgoCdGetProject',
    'method' => 'GET',
    'path' => '/api/v1/projects/{name}',
    'operation_id' => 'ProjectService_Get',
    'name' => 'Get returns a project by name',
    'description' => 'Get returns a project by name',
    'type' => 'read',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'name',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => '',
      ),
    ),
    'request_body' => NULL,
  ),
  'argocd_project_delete' =>
  array (
    'slug' => 'argocd_project_delete',
    'class' => 'ArgoCdProjectDelete',
    'method' => 'DELETE',
    'path' => '/api/v1/projects/{name}',
    'operation_id' => 'ProjectService_Delete',
    'name' => 'Delete deletes a project',
    'description' => 'Delete deletes a project',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'name',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => '',
      ),
    ),
    'request_body' => NULL,
  ),
  'argocd_project_get_detailed_project' =>
  array (
    'slug' => 'argocd_project_get_detailed_project',
    'class' => 'ArgoCdProjectGetDetailedProject',
    'method' => 'GET',
    'path' => '/api/v1/projects/{name}/detailed',
    'operation_id' => 'ProjectService_GetDetailedProject',
    'name' => 'GetDetailedProject returns a project that include project, global project and scoped resources by name',
    'description' => 'GetDetailedProject returns a project that include project, global project and scoped resources by name',
    'type' => 'read',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'name',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => '',
      ),
    ),
    'request_body' => NULL,
  ),
  'argocd_project_list_events' =>
  array (
    'slug' => 'argocd_project_list_events',
    'class' => 'ArgoCdProjectListEvents',
    'method' => 'GET',
    'path' => '/api/v1/projects/{name}/events',
    'operation_id' => 'ProjectService_ListEvents',
    'name' => 'ListEvents returns a list of project events',
    'description' => 'ListEvents returns a list of project events',
    'type' => 'read',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'name',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => '',
      ),
    ),
    'request_body' => NULL,
  ),
  'argocd_project_get_global_projects' =>
  array (
    'slug' => 'argocd_project_get_global_projects',
    'class' => 'ArgoCdProjectGetGlobalProjects',
    'method' => 'GET',
    'path' => '/api/v1/projects/{name}/globalprojects',
    'operation_id' => 'ProjectService_GetGlobalProjects',
    'name' => 'Get returns a virtual project by name',
    'description' => 'Get returns a virtual project by name',
    'type' => 'read',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'name',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => '',
      ),
    ),
    'request_body' => NULL,
  ),
  'argocd_project_list_links' =>
  array (
    'slug' => 'argocd_project_list_links',
    'class' => 'ArgoCdProjectListLinks',
    'method' => 'GET',
    'path' => '/api/v1/projects/{name}/links',
    'operation_id' => 'ProjectService_ListLinks',
    'name' => 'ListLinks returns all deep links for the particular project',
    'description' => 'ListLinks returns all deep links for the particular project',
    'type' => 'read',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'name',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => '',
      ),
    ),
    'request_body' => NULL,
  ),
  'argocd_project_get_sync_windows_state' =>
  array (
    'slug' => 'argocd_project_get_sync_windows_state',
    'class' => 'ArgoCdProjectGetSyncWindowsState',
    'method' => 'GET',
    'path' => '/api/v1/projects/{name}/syncwindows',
    'operation_id' => 'ProjectService_GetSyncWindowsState',
    'name' => 'GetSchedulesState returns true if there are any active sync syncWindows',
    'description' => 'GetSchedulesState returns true if there are any active sync syncWindows',
    'type' => 'read',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'name',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => '',
      ),
    ),
    'request_body' => NULL,
  ),
  'argocd_project_update' =>
  array (
    'slug' => 'argocd_project_update',
    'class' => 'ArgoCdProjectUpdate',
    'method' => 'PUT',
    'path' => '/api/v1/projects/{project.metadata.name}',
    'operation_id' => 'ProjectService_Update',
    'name' => 'Update updates a project',
    'description' => 'Update updates a project',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project.metadata.name',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'Name must be unique within a namespace. Is required when creating resources, although some resources may allow a client to request the generation of an appropriate name automatically. Name is primarily intended for creation idempotence and configuration definition. Cannot be updated. More info: https://kubernetes.io/docs/concepts/overview/working-with-objects/namesnames +optional',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Request body for the Argo CD API operation.',
    ),
  ),
  'argocd_project_create_token' =>
  array (
    'slug' => 'argocd_project_create_token',
    'class' => 'ArgoCdProjectCreateToken',
    'method' => 'POST',
    'path' => '/api/v1/projects/{project}/roles/{role}/token',
    'operation_id' => 'ProjectService_CreateToken',
    'name' => 'Create a new project token',
    'description' => 'Create a new project token',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => '',
      ),
      1 =>
      array (
        'name' => 'role',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => '',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Request body for the Argo CD API operation.',
    ),
  ),
  'argocd_project_delete_token' =>
  array (
    'slug' => 'argocd_project_delete_token',
    'class' => 'ArgoCdProjectDeleteToken',
    'method' => 'DELETE',
    'path' => '/api/v1/projects/{project}/roles/{role}/token/{iat}',
    'operation_id' => 'ProjectService_DeleteToken',
    'name' => 'Delete a new project token',
    'description' => 'Delete a new project token',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'project',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => '',
      ),
      1 =>
      array (
        'name' => 'role',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => '',
      ),
      2 =>
      array (
        'name' => 'iat',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => '',
      ),
      3 =>
      array (
        'name' => 'id',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
    ),
    'request_body' => NULL,
  ),
  'argocd_repo_creds_list_repository_credentials' =>
  array (
    'slug' => 'argocd_repo_creds_list_repository_credentials',
    'class' => 'ArgoCdRepoCredsListRepositoryCredentials',
    'method' => 'GET',
    'path' => '/api/v1/repocreds',
    'operation_id' => 'RepoCredsService_ListRepositoryCredentials',
    'name' => 'ListRepositoryCredentials gets a list of all configured repository credential sets',
    'description' => 'ListRepositoryCredentials gets a list of all configured repository credential sets',
    'type' => 'read',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'url',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Repo URL for query.',
      ),
    ),
    'request_body' => NULL,
  ),
  'argocd_repo_creds_create_repository_credentials' =>
  array (
    'slug' => 'argocd_repo_creds_create_repository_credentials',
    'class' => 'ArgoCdRepoCredsCreateRepositoryCredentials',
    'method' => 'POST',
    'path' => '/api/v1/repocreds',
    'operation_id' => 'RepoCredsService_CreateRepositoryCredentials',
    'name' => 'CreateRepositoryCredentials creates a new repository credential set',
    'description' => 'CreateRepositoryCredentials creates a new repository credential set',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'upsert',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'boolean',
        'description' => 'Whether to create in upsert mode.',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Repository definition',
    ),
  ),
  'argocd_repo_creds_update_repository_credentials' =>
  array (
    'slug' => 'argocd_repo_creds_update_repository_credentials',
    'class' => 'ArgoCdRepoCredsUpdateRepositoryCredentials',
    'method' => 'PUT',
    'path' => '/api/v1/repocreds/{creds.url}',
    'operation_id' => 'RepoCredsService_UpdateRepositoryCredentials',
    'name' => 'UpdateRepositoryCredentials updates a repository credential set',
    'description' => 'UpdateRepositoryCredentials updates a repository credential set',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'creds.url',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'URL is the URL to which these credentials match',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Request body for the Argo CD API operation.',
    ),
  ),
  'argocd_repo_creds_delete_repository_credentials' =>
  array (
    'slug' => 'argocd_repo_creds_delete_repository_credentials',
    'class' => 'ArgoCdRepoCredsDeleteRepositoryCredentials',
    'method' => 'DELETE',
    'path' => '/api/v1/repocreds/{url}',
    'operation_id' => 'RepoCredsService_DeleteRepositoryCredentials',
    'name' => 'DeleteRepositoryCredentials deletes a repository credential set from the configuration',
    'description' => 'DeleteRepositoryCredentials deletes a repository credential set from the configuration',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'url',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => '',
      ),
    ),
    'request_body' => NULL,
  ),
  'argocd_list_repositories' =>
  array (
    'slug' => 'argocd_list_repositories',
    'class' => 'ArgoCdListRepositories',
    'method' => 'GET',
    'path' => '/api/v1/repositories',
    'operation_id' => 'RepositoryService_ListRepositories',
    'name' => 'ListRepositories gets a list of all configured repositories',
    'description' => 'ListRepositories gets a list of all configured repositories',
    'type' => 'read',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'repo',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Repo URL for query.',
      ),
      1 =>
      array (
        'name' => 'forceRefresh',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'boolean',
        'description' => 'Whether to force a cache refresh on repo\'s connection state.',
      ),
      2 =>
      array (
        'name' => 'appProject',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'App project for query.',
      ),
    ),
    'request_body' => NULL,
  ),
  'argocd_repository_create_repository' =>
  array (
    'slug' => 'argocd_repository_create_repository',
    'class' => 'ArgoCdRepositoryCreateRepository',
    'method' => 'POST',
    'path' => '/api/v1/repositories',
    'operation_id' => 'RepositoryService_CreateRepository',
    'name' => 'CreateRepository creates a new repository configuration',
    'description' => 'CreateRepository creates a new repository configuration',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'upsert',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'boolean',
        'description' => 'Whether to create in upsert mode.',
      ),
      1 =>
      array (
        'name' => 'credsOnly',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'boolean',
        'description' => 'Whether to operate on credential set instead of repository.',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Repository definition',
    ),
  ),
  'argocd_repository_update_repository' =>
  array (
    'slug' => 'argocd_repository_update_repository',
    'class' => 'ArgoCdRepositoryUpdateRepository',
    'method' => 'PUT',
    'path' => '/api/v1/repositories/{repo.repo}',
    'operation_id' => 'RepositoryService_UpdateRepository',
    'name' => 'UpdateRepository updates a repository configuration',
    'description' => 'UpdateRepository updates a repository configuration',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'repo.repo',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'Repo contains the URL to the remote repository',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Request body for the Argo CD API operation.',
    ),
  ),
  'argocd_repository_get' =>
  array (
    'slug' => 'argocd_repository_get',
    'class' => 'ArgoCdRepositoryGet',
    'method' => 'GET',
    'path' => '/api/v1/repositories/{repo}',
    'operation_id' => 'RepositoryService_Get',
    'name' => 'Get returns a repository or its credentials',
    'description' => 'Get returns a repository or its credentials',
    'type' => 'read',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'repo',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'Repo URL for query',
      ),
      1 =>
      array (
        'name' => 'forceRefresh',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'boolean',
        'description' => 'Whether to force a cache refresh on repo\'s connection state.',
      ),
      2 =>
      array (
        'name' => 'appProject',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'App project for query.',
      ),
    ),
    'request_body' => NULL,
  ),
  'argocd_repository_delete_repository' =>
  array (
    'slug' => 'argocd_repository_delete_repository',
    'class' => 'ArgoCdRepositoryDeleteRepository',
    'method' => 'DELETE',
    'path' => '/api/v1/repositories/{repo}',
    'operation_id' => 'RepositoryService_DeleteRepository',
    'name' => 'DeleteRepository deletes a repository from the configuration',
    'description' => 'DeleteRepository deletes a repository from the configuration',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'repo',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'Repo URL for query',
      ),
      1 =>
      array (
        'name' => 'forceRefresh',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'boolean',
        'description' => 'Whether to force a cache refresh on repo\'s connection state.',
      ),
      2 =>
      array (
        'name' => 'appProject',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'App project for query.',
      ),
    ),
    'request_body' => NULL,
  ),
  'argocd_repository_list_apps' =>
  array (
    'slug' => 'argocd_repository_list_apps',
    'class' => 'ArgoCdRepositoryListApps',
    'method' => 'GET',
    'path' => '/api/v1/repositories/{repo}/apps',
    'operation_id' => 'RepositoryService_ListApps',
    'name' => 'ListApps returns list of apps in the repo',
    'description' => 'ListApps returns list of apps in the repo',
    'type' => 'read',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'repo',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => '',
      ),
      1 =>
      array (
        'name' => 'revision',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
      2 =>
      array (
        'name' => 'appName',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
      3 =>
      array (
        'name' => 'appProject',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
    ),
    'request_body' => NULL,
  ),
  'argocd_repository_get_helm_charts' =>
  array (
    'slug' => 'argocd_repository_get_helm_charts',
    'class' => 'ArgoCdRepositoryGetHelmCharts',
    'method' => 'GET',
    'path' => '/api/v1/repositories/{repo}/helmcharts',
    'operation_id' => 'RepositoryService_GetHelmCharts',
    'name' => 'GetHelmCharts returns list of helm charts in the specified repository',
    'description' => 'GetHelmCharts returns list of helm charts in the specified repository',
    'type' => 'read',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'repo',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'Repo URL for query',
      ),
      1 =>
      array (
        'name' => 'forceRefresh',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'boolean',
        'description' => 'Whether to force a cache refresh on repo\'s connection state.',
      ),
      2 =>
      array (
        'name' => 'appProject',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'App project for query.',
      ),
    ),
    'request_body' => NULL,
  ),
  'argocd_repository_list_o_c_i_tags' =>
  array (
    'slug' => 'argocd_repository_list_o_c_i_tags',
    'class' => 'ArgoCdRepositoryListOCITags',
    'method' => 'GET',
    'path' => '/api/v1/repositories/{repo}/oci-tags',
    'operation_id' => 'RepositoryService_ListOCITags',
    'name' => 'RepositoryServiceListOCITags',
    'description' => 'RepositoryServiceListOCITags',
    'type' => 'read',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'repo',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'Repo URL for query',
      ),
      1 =>
      array (
        'name' => 'forceRefresh',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'boolean',
        'description' => 'Whether to force a cache refresh on repo\'s connection state.',
      ),
      2 =>
      array (
        'name' => 'appProject',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'App project for query.',
      ),
    ),
    'request_body' => NULL,
  ),
  'argocd_repository_list_refs' =>
  array (
    'slug' => 'argocd_repository_list_refs',
    'class' => 'ArgoCdRepositoryListRefs',
    'method' => 'GET',
    'path' => '/api/v1/repositories/{repo}/refs',
    'operation_id' => 'RepositoryService_ListRefs',
    'name' => 'RepositoryServiceListRefs',
    'description' => 'RepositoryServiceListRefs',
    'type' => 'read',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'repo',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'Repo URL for query',
      ),
      1 =>
      array (
        'name' => 'forceRefresh',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'boolean',
        'description' => 'Whether to force a cache refresh on repo\'s connection state.',
      ),
      2 =>
      array (
        'name' => 'appProject',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'App project for query.',
      ),
    ),
    'request_body' => NULL,
  ),
  'argocd_repository_validate_access' =>
  array (
    'slug' => 'argocd_repository_validate_access',
    'class' => 'ArgoCdRepositoryValidateAccess',
    'method' => 'POST',
    'path' => '/api/v1/repositories/{repo}/validate',
    'operation_id' => 'RepositoryService_ValidateAccess',
    'name' => 'ValidateAccess validates access to a repository with given parameters',
    'description' => 'ValidateAccess validates access to a repository with given parameters',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'repo',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The URL to the repo',
      ),
      1 =>
      array (
        'name' => 'username',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Username for accessing repo.',
      ),
      2 =>
      array (
        'name' => 'password',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Password for accessing repo.',
      ),
      3 =>
      array (
        'name' => 'sshPrivateKey',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Private key data for accessing SSH repository.',
      ),
      4 =>
      array (
        'name' => 'insecure',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'boolean',
        'description' => 'Whether to skip certificate or host key validation.',
      ),
      5 =>
      array (
        'name' => 'tlsClientCertData',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'TLS client cert data for accessing HTTPS repository.',
      ),
      6 =>
      array (
        'name' => 'tlsClientCertKey',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'TLS client cert key for accessing HTTPS repository.',
      ),
      7 =>
      array (
        'name' => 'type',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'The type of the repo.',
      ),
      8 =>
      array (
        'name' => 'name',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'The name of the repo.',
      ),
      9 =>
      array (
        'name' => 'enableOci',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'boolean',
        'description' => 'Whether helm-oci support should be enabled for this repo.',
      ),
      10 =>
      array (
        'name' => 'githubAppPrivateKey',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Github App Private Key PEM data.',
      ),
      11 =>
      array (
        'name' => 'githubAppID',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Github App ID of the app used to access the repo.',
      ),
      12 =>
      array (
        'name' => 'githubAppInstallationID',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Github App Installation ID of the installed GitHub App.',
      ),
      13 =>
      array (
        'name' => 'githubAppEnterpriseBaseUrl',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Github App Enterprise base url if empty will default to https://api.github.com.',
      ),
      14 =>
      array (
        'name' => 'proxy',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'HTTP/HTTPS proxy to access the repository.',
      ),
      15 =>
      array (
        'name' => 'project',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Reference between project and repository that allow you automatically to be added as item inside SourceRepos project entity.',
      ),
      16 =>
      array (
        'name' => 'gcpServiceAccountKey',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Google Cloud Platform service account key.',
      ),
      17 =>
      array (
        'name' => 'forceHttpBasicAuth',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'boolean',
        'description' => 'Whether to force HTTP basic auth.',
      ),
      18 =>
      array (
        'name' => 'useAzureWorkloadIdentity',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'boolean',
        'description' => 'Whether to use azure workload identity for authentication.',
      ),
      19 =>
      array (
        'name' => 'bearerToken',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'BearerToken contains the bearer token used for Git auth at the repo server.',
      ),
      20 =>
      array (
        'name' => 'insecureOciForceHttp',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'boolean',
        'description' => 'Whether https should be disabled for an OCI repo.',
      ),
      21 =>
      array (
        'name' => 'azureServicePrincipalClientId',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Azure Service Principal Client ID.',
      ),
      22 =>
      array (
        'name' => 'azureServicePrincipalClientSecret',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Azure Service Principal Client Secret.',
      ),
      23 =>
      array (
        'name' => 'azureServicePrincipalTenantId',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Azure Service Principal Tenant ID.',
      ),
      24 =>
      array (
        'name' => 'azureActiveDirectoryEndpoint',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Azure Active Directory Endpoint.',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'string',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'The URL to the repo',
    ),
  ),
  'argocd_repository_get_app_details' =>
  array (
    'slug' => 'argocd_repository_get_app_details',
    'class' => 'ArgoCdRepositoryGetAppDetails',
    'method' => 'POST',
    'path' => '/api/v1/repositories/{source.repoURL}/appdetails',
    'operation_id' => 'RepositoryService_GetAppDetails',
    'name' => 'GetAppDetails returns application details by given path',
    'description' => 'GetAppDetails returns application details by given path',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'source.repoURL',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'RepoURL is the URL to the repository Git or Helm that contains the application manifests',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Request body for the Argo CD API operation.',
    ),
  ),
  'argocd_session_create' =>
  array (
    'slug' => 'argocd_session_create',
    'class' => 'ArgoCdSessionCreate',
    'method' => 'POST',
    'path' => '/api/v1/session',
    'operation_id' => 'SessionService_Create',
    'name' => 'Create a new JWT for authentication and set a cookie if using HTTP',
    'description' => 'Create a new JWT for authentication and set a cookie if using HTTP',
    'type' => 'write',
    'auth_required' => false,
    'parameters' =>
    array (
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Request body for the Argo CD API operation.',
    ),
  ),
  'argocd_session_delete' =>
  array (
    'slug' => 'argocd_session_delete',
    'class' => 'ArgoCdSessionDelete',
    'method' => 'DELETE',
    'path' => '/api/v1/session',
    'operation_id' => 'SessionService_Delete',
    'name' => 'Delete an existing JWT cookie if using HTTP',
    'description' => 'Delete an existing JWT cookie if using HTTP',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'argocd_get_current_user' =>
  array (
    'slug' => 'argocd_get_current_user',
    'class' => 'ArgoCdGetCurrentUser',
    'method' => 'GET',
    'path' => '/api/v1/session/userinfo',
    'operation_id' => 'SessionService_GetUserInfo',
    'name' => 'Get the current user\'s info',
    'description' => 'Get the current user\'s info',
    'type' => 'read',
    'auth_required' => true,
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'argocd_settings_get' =>
  array (
    'slug' => 'argocd_settings_get',
    'class' => 'ArgoCdSettingsGet',
    'method' => 'GET',
    'path' => '/api/v1/settings',
    'operation_id' => 'SettingsService_Get',
    'name' => 'Get returns Argo CD settings',
    'description' => 'Get returns Argo CD settings',
    'type' => 'read',
    'auth_required' => true,
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'argocd_settings_get_plugins' =>
  array (
    'slug' => 'argocd_settings_get_plugins',
    'class' => 'ArgoCdSettingsGetPlugins',
    'method' => 'GET',
    'path' => '/api/v1/settings/plugins',
    'operation_id' => 'SettingsService_GetPlugins',
    'name' => 'Get returns Argo CD plugins',
    'description' => 'Get returns Argo CD plugins',
    'type' => 'read',
    'auth_required' => true,
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
  'argocd_application_watch' =>
  array (
    'slug' => 'argocd_application_watch',
    'class' => 'ArgoCdApplicationWatch',
    'method' => 'GET',
    'path' => '/api/v1/stream/applications',
    'operation_id' => 'ApplicationService_Watch',
    'name' => 'Watch returns stream of application change events',
    'description' => 'Watch returns stream of application change events',
    'type' => 'read',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'name',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'the application\'s name.',
      ),
      1 =>
      array (
        'name' => 'refresh',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'forces application reconciliation if set to \'hard\'.',
      ),
      2 =>
      array (
        'name' => 'projects',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'array',
        'description' => 'the project names to restrict returned list applications.',
      ),
      3 =>
      array (
        'name' => 'resourceVersion',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'when specified with a watch call, shows changes that occur after that particular version of a resource.',
      ),
      4 =>
      array (
        'name' => 'selector',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'the selector to restrict returned list to applications only with matched labels.',
      ),
      5 =>
      array (
        'name' => 'repo',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'the repoURL to restrict returned list applications.',
      ),
      6 =>
      array (
        'name' => 'appNamespace',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'the application\'s namespace.',
      ),
      7 =>
      array (
        'name' => 'project',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'array',
        'description' => 'the project names to restrict returned list applications legacy name for backwards-compatibility.',
      ),
    ),
    'request_body' => NULL,
  ),
  'argocd_application_watch_resource_tree' =>
  array (
    'slug' => 'argocd_application_watch_resource_tree',
    'class' => 'ArgoCdApplicationWatchResourceTree',
    'method' => 'GET',
    'path' => '/api/v1/stream/applications/{applicationName}/resource-tree',
    'operation_id' => 'ApplicationService_WatchResourceTree',
    'name' => 'Watch returns stream of application resource tree',
    'description' => 'Watch returns stream of application resource tree',
    'type' => 'read',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'applicationName',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => '',
      ),
      1 =>
      array (
        'name' => 'namespace',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
      2 =>
      array (
        'name' => 'name',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
      3 =>
      array (
        'name' => 'version',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
      4 =>
      array (
        'name' => 'group',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
      5 =>
      array (
        'name' => 'kind',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
      6 =>
      array (
        'name' => 'appNamespace',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
      7 =>
      array (
        'name' => 'project',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
    ),
    'request_body' => NULL,
  ),
  'argocd_application_set_watch' =>
  array (
    'slug' => 'argocd_application_set_watch',
    'class' => 'ArgoCdApplicationSetWatch',
    'method' => 'GET',
    'path' => '/api/v1/stream/applicationsets',
    'operation_id' => 'ApplicationSetService_Watch',
    'name' => 'ApplicationSetServiceWatch',
    'description' => 'ApplicationSetServiceWatch',
    'type' => 'read',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'name',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
      1 =>
      array (
        'name' => 'projects',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'array',
        'description' => '',
      ),
      2 =>
      array (
        'name' => 'selector',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
      3 =>
      array (
        'name' => 'appSetNamespace',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => '',
      ),
      4 =>
      array (
        'name' => 'resourceVersion',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'when specified with a watch call, shows changes that occur after that particular version of a resource.',
      ),
    ),
    'request_body' => NULL,
  ),
  'argocd_repo_creds_list_write_repository_credentials' =>
  array (
    'slug' => 'argocd_repo_creds_list_write_repository_credentials',
    'class' => 'ArgoCdRepoCredsListWriteRepositoryCredentials',
    'method' => 'GET',
    'path' => '/api/v1/write-repocreds',
    'operation_id' => 'RepoCredsService_ListWriteRepositoryCredentials',
    'name' => 'ListWriteRepositoryCredentials gets a list of all configured repository credential sets that have write access',
    'description' => 'ListWriteRepositoryCredentials gets a list of all configured repository credential sets that have write access',
    'type' => 'read',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'url',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Repo URL for query.',
      ),
    ),
    'request_body' => NULL,
  ),
  'argocd_repo_creds_create_write_repository_credentials' =>
  array (
    'slug' => 'argocd_repo_creds_create_write_repository_credentials',
    'class' => 'ArgoCdRepoCredsCreateWriteRepositoryCredentials',
    'method' => 'POST',
    'path' => '/api/v1/write-repocreds',
    'operation_id' => 'RepoCredsService_CreateWriteRepositoryCredentials',
    'name' => 'CreateWriteRepositoryCredentials creates a new repository credential set with write access',
    'description' => 'CreateWriteRepositoryCredentials creates a new repository credential set with write access',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'upsert',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'boolean',
        'description' => 'Whether to create in upsert mode.',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Repository definition',
    ),
  ),
  'argocd_repo_creds_update_write_repository_credentials' =>
  array (
    'slug' => 'argocd_repo_creds_update_write_repository_credentials',
    'class' => 'ArgoCdRepoCredsUpdateWriteRepositoryCredentials',
    'method' => 'PUT',
    'path' => '/api/v1/write-repocreds/{creds.url}',
    'operation_id' => 'RepoCredsService_UpdateWriteRepositoryCredentials',
    'name' => 'UpdateWriteRepositoryCredentials updates a repository credential set with write access',
    'description' => 'UpdateWriteRepositoryCredentials updates a repository credential set with write access',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'creds.url',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'URL is the URL to which these credentials match',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Request body for the Argo CD API operation.',
    ),
  ),
  'argocd_repo_creds_delete_write_repository_credentials' =>
  array (
    'slug' => 'argocd_repo_creds_delete_write_repository_credentials',
    'class' => 'ArgoCdRepoCredsDeleteWriteRepositoryCredentials',
    'method' => 'DELETE',
    'path' => '/api/v1/write-repocreds/{url}',
    'operation_id' => 'RepoCredsService_DeleteWriteRepositoryCredentials',
    'name' => 'DeleteWriteRepositoryCredentials deletes a repository credential set with write access from the configuration',
    'description' => 'DeleteWriteRepositoryCredentials deletes a repository credential set with write access from the configuration',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'url',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => '',
      ),
    ),
    'request_body' => NULL,
  ),
  'argocd_repository_list_write_repositories' =>
  array (
    'slug' => 'argocd_repository_list_write_repositories',
    'class' => 'ArgoCdRepositoryListWriteRepositories',
    'method' => 'GET',
    'path' => '/api/v1/write-repositories',
    'operation_id' => 'RepositoryService_ListWriteRepositories',
    'name' => 'ListWriteRepositories gets a list of all configured write repositories',
    'description' => 'ListWriteRepositories gets a list of all configured write repositories',
    'type' => 'read',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'repo',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Repo URL for query.',
      ),
      1 =>
      array (
        'name' => 'forceRefresh',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'boolean',
        'description' => 'Whether to force a cache refresh on repo\'s connection state.',
      ),
      2 =>
      array (
        'name' => 'appProject',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'App project for query.',
      ),
    ),
    'request_body' => NULL,
  ),
  'argocd_repository_create_write_repository' =>
  array (
    'slug' => 'argocd_repository_create_write_repository',
    'class' => 'ArgoCdRepositoryCreateWriteRepository',
    'method' => 'POST',
    'path' => '/api/v1/write-repositories',
    'operation_id' => 'RepositoryService_CreateWriteRepository',
    'name' => 'CreateWriteRepository creates a new write repository configuration',
    'description' => 'CreateWriteRepository creates a new write repository configuration',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'upsert',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'boolean',
        'description' => 'Whether to create in upsert mode.',
      ),
      1 =>
      array (
        'name' => 'credsOnly',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'boolean',
        'description' => 'Whether to operate on credential set instead of repository.',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Repository definition',
    ),
  ),
  'argocd_repository_update_write_repository' =>
  array (
    'slug' => 'argocd_repository_update_write_repository',
    'class' => 'ArgoCdRepositoryUpdateWriteRepository',
    'method' => 'PUT',
    'path' => '/api/v1/write-repositories/{repo.repo}',
    'operation_id' => 'RepositoryService_UpdateWriteRepository',
    'name' => 'UpdateWriteRepository updates a write repository configuration',
    'description' => 'UpdateWriteRepository updates a write repository configuration',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'repo.repo',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'Repo contains the URL to the remote repository',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'object',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'Request body for the Argo CD API operation.',
    ),
  ),
  'argocd_repository_get_write' =>
  array (
    'slug' => 'argocd_repository_get_write',
    'class' => 'ArgoCdRepositoryGetWrite',
    'method' => 'GET',
    'path' => '/api/v1/write-repositories/{repo}',
    'operation_id' => 'RepositoryService_GetWrite',
    'name' => 'GetWrite returns a repository or its write credentials',
    'description' => 'GetWrite returns a repository or its write credentials',
    'type' => 'read',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'repo',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'Repo URL for query',
      ),
      1 =>
      array (
        'name' => 'forceRefresh',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'boolean',
        'description' => 'Whether to force a cache refresh on repo\'s connection state.',
      ),
      2 =>
      array (
        'name' => 'appProject',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'App project for query.',
      ),
    ),
    'request_body' => NULL,
  ),
  'argocd_repository_delete_write_repository' =>
  array (
    'slug' => 'argocd_repository_delete_write_repository',
    'class' => 'ArgoCdRepositoryDeleteWriteRepository',
    'method' => 'DELETE',
    'path' => '/api/v1/write-repositories/{repo}',
    'operation_id' => 'RepositoryService_DeleteWriteRepository',
    'name' => 'DeleteWriteRepository deletes a write repository from the configuration',
    'description' => 'DeleteWriteRepository deletes a write repository from the configuration',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'repo',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'Repo URL for query',
      ),
      1 =>
      array (
        'name' => 'forceRefresh',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'boolean',
        'description' => 'Whether to force a cache refresh on repo\'s connection state.',
      ),
      2 =>
      array (
        'name' => 'appProject',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'App project for query.',
      ),
    ),
    'request_body' => NULL,
  ),
  'argocd_repository_validate_write_access' =>
  array (
    'slug' => 'argocd_repository_validate_write_access',
    'class' => 'ArgoCdRepositoryValidateWriteAccess',
    'method' => 'POST',
    'path' => '/api/v1/write-repositories/{repo}/validate',
    'operation_id' => 'RepositoryService_ValidateWriteAccess',
    'name' => 'ValidateWriteAccess validates write access to a repository with given parameters',
    'description' => 'ValidateWriteAccess validates write access to a repository with given parameters',
    'type' => 'write',
    'auth_required' => true,
    'parameters' =>
    array (
      0 =>
      array (
        'name' => 'repo',
        'in' => 'path',
        'required' => true,
        'schema_type' => 'string',
        'description' => 'The URL to the repo',
      ),
      1 =>
      array (
        'name' => 'username',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Username for accessing repo.',
      ),
      2 =>
      array (
        'name' => 'password',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Password for accessing repo.',
      ),
      3 =>
      array (
        'name' => 'sshPrivateKey',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Private key data for accessing SSH repository.',
      ),
      4 =>
      array (
        'name' => 'insecure',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'boolean',
        'description' => 'Whether to skip certificate or host key validation.',
      ),
      5 =>
      array (
        'name' => 'tlsClientCertData',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'TLS client cert data for accessing HTTPS repository.',
      ),
      6 =>
      array (
        'name' => 'tlsClientCertKey',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'TLS client cert key for accessing HTTPS repository.',
      ),
      7 =>
      array (
        'name' => 'type',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'The type of the repo.',
      ),
      8 =>
      array (
        'name' => 'name',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'The name of the repo.',
      ),
      9 =>
      array (
        'name' => 'enableOci',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'boolean',
        'description' => 'Whether helm-oci support should be enabled for this repo.',
      ),
      10 =>
      array (
        'name' => 'githubAppPrivateKey',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Github App Private Key PEM data.',
      ),
      11 =>
      array (
        'name' => 'githubAppID',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Github App ID of the app used to access the repo.',
      ),
      12 =>
      array (
        'name' => 'githubAppInstallationID',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Github App Installation ID of the installed GitHub App.',
      ),
      13 =>
      array (
        'name' => 'githubAppEnterpriseBaseUrl',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Github App Enterprise base url if empty will default to https://api.github.com.',
      ),
      14 =>
      array (
        'name' => 'proxy',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'HTTP/HTTPS proxy to access the repository.',
      ),
      15 =>
      array (
        'name' => 'project',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Reference between project and repository that allow you automatically to be added as item inside SourceRepos project entity.',
      ),
      16 =>
      array (
        'name' => 'gcpServiceAccountKey',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Google Cloud Platform service account key.',
      ),
      17 =>
      array (
        'name' => 'forceHttpBasicAuth',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'boolean',
        'description' => 'Whether to force HTTP basic auth.',
      ),
      18 =>
      array (
        'name' => 'useAzureWorkloadIdentity',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'boolean',
        'description' => 'Whether to use azure workload identity for authentication.',
      ),
      19 =>
      array (
        'name' => 'bearerToken',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'BearerToken contains the bearer token used for Git auth at the repo server.',
      ),
      20 =>
      array (
        'name' => 'insecureOciForceHttp',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'boolean',
        'description' => 'Whether https should be disabled for an OCI repo.',
      ),
      21 =>
      array (
        'name' => 'azureServicePrincipalClientId',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Azure Service Principal Client ID.',
      ),
      22 =>
      array (
        'name' => 'azureServicePrincipalClientSecret',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Azure Service Principal Client Secret.',
      ),
      23 =>
      array (
        'name' => 'azureServicePrincipalTenantId',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Azure Service Principal Tenant ID.',
      ),
      24 =>
      array (
        'name' => 'azureActiveDirectoryEndpoint',
        'in' => 'query',
        'required' => false,
        'schema_type' => 'string',
        'description' => 'Azure Active Directory Endpoint.',
      ),
    ),
    'request_body' =>
    array (
      'required' => true,
      'schema_type' => 'string',
      'content_types' =>
      array (
        0 => 'application/json',
      ),
      'description' => 'The URL to the repo',
    ),
  ),
  'argocd_version_version' =>
  array (
    'slug' => 'argocd_version_version',
    'class' => 'ArgoCdVersionVersion',
    'method' => 'GET',
    'path' => '/api/version',
    'operation_id' => 'VersionService_Version',
    'name' => 'Version returns version information of the API server',
    'description' => 'Version returns version information of the API server',
    'type' => 'read',
    'auth_required' => false,
    'parameters' =>
    array (
    ),
    'request_body' => NULL,
  ),
);
    }
}
