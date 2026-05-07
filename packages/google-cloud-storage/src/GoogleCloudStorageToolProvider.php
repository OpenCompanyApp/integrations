<?php

namespace OpenCompany\Integrations\GoogleCloudStorage;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\GoogleCloudStorage\Tools\GoogleCloudStorageAnywhereCachesInsert;
use OpenCompany\Integrations\GoogleCloudStorage\Tools\GoogleCloudStorageAnywhereCachesUpdate;
use OpenCompany\Integrations\GoogleCloudStorage\Tools\GoogleCloudStorageAnywhereCachesGet;
use OpenCompany\Integrations\GoogleCloudStorage\Tools\GoogleCloudStorageAnywhereCachesList;
use OpenCompany\Integrations\GoogleCloudStorage\Tools\GoogleCloudStorageAnywhereCachesPause;
use OpenCompany\Integrations\GoogleCloudStorage\Tools\GoogleCloudStorageAnywhereCachesResume;
use OpenCompany\Integrations\GoogleCloudStorage\Tools\GoogleCloudStorageAnywhereCachesDisable;
use OpenCompany\Integrations\GoogleCloudStorage\Tools\GoogleCloudStorageBucketAccessControlsDelete;
use OpenCompany\Integrations\GoogleCloudStorage\Tools\GoogleCloudStorageBucketAccessControlsGet;
use OpenCompany\Integrations\GoogleCloudStorage\Tools\GoogleCloudStorageBucketAccessControlsInsert;
use OpenCompany\Integrations\GoogleCloudStorage\Tools\GoogleCloudStorageBucketAccessControlsList;
use OpenCompany\Integrations\GoogleCloudStorage\Tools\GoogleCloudStorageBucketAccessControlsPatch;
use OpenCompany\Integrations\GoogleCloudStorage\Tools\GoogleCloudStorageBucketAccessControlsUpdate;
use OpenCompany\Integrations\GoogleCloudStorage\Tools\GoogleCloudStorageBucketsDelete;
use OpenCompany\Integrations\GoogleCloudStorage\Tools\GoogleCloudStorageBucketsRestore;
use OpenCompany\Integrations\GoogleCloudStorage\Tools\GoogleCloudStorageBucketsRelocate;
use OpenCompany\Integrations\GoogleCloudStorage\Tools\GoogleCloudStorageBucketsGet;
use OpenCompany\Integrations\GoogleCloudStorage\Tools\GoogleCloudStorageBucketsGetIamPolicy;
use OpenCompany\Integrations\GoogleCloudStorage\Tools\GoogleCloudStorageBucketsGetStorageLayout;
use OpenCompany\Integrations\GoogleCloudStorage\Tools\GoogleCloudStorageBucketsInsert;
use OpenCompany\Integrations\GoogleCloudStorage\Tools\GoogleCloudStorageBucketsList;
use OpenCompany\Integrations\GoogleCloudStorage\Tools\GoogleCloudStorageBucketsLockRetentionPolicy;
use OpenCompany\Integrations\GoogleCloudStorage\Tools\GoogleCloudStorageBucketsPatch;
use OpenCompany\Integrations\GoogleCloudStorage\Tools\GoogleCloudStorageBucketsSetIamPolicy;
use OpenCompany\Integrations\GoogleCloudStorage\Tools\GoogleCloudStorageBucketsTestIamPermissions;
use OpenCompany\Integrations\GoogleCloudStorage\Tools\GoogleCloudStorageBucketsUpdate;
use OpenCompany\Integrations\GoogleCloudStorage\Tools\GoogleCloudStorageOperationsCancel;
use OpenCompany\Integrations\GoogleCloudStorage\Tools\GoogleCloudStorageOperationsGet;
use OpenCompany\Integrations\GoogleCloudStorage\Tools\GoogleCloudStorageOperationsAdvanceRelocateBucket;
use OpenCompany\Integrations\GoogleCloudStorage\Tools\GoogleCloudStorageOperationsList;
use OpenCompany\Integrations\GoogleCloudStorage\Tools\GoogleCloudStorageChannelsStop;
use OpenCompany\Integrations\GoogleCloudStorage\Tools\GoogleCloudStorageDefaultObjectAccessControlsDelete;
use OpenCompany\Integrations\GoogleCloudStorage\Tools\GoogleCloudStorageDefaultObjectAccessControlsGet;
use OpenCompany\Integrations\GoogleCloudStorage\Tools\GoogleCloudStorageDefaultObjectAccessControlsInsert;
use OpenCompany\Integrations\GoogleCloudStorage\Tools\GoogleCloudStorageDefaultObjectAccessControlsList;
use OpenCompany\Integrations\GoogleCloudStorage\Tools\GoogleCloudStorageDefaultObjectAccessControlsPatch;
use OpenCompany\Integrations\GoogleCloudStorage\Tools\GoogleCloudStorageDefaultObjectAccessControlsUpdate;
use OpenCompany\Integrations\GoogleCloudStorage\Tools\GoogleCloudStorageFoldersDelete;
use OpenCompany\Integrations\GoogleCloudStorage\Tools\GoogleCloudStorageFoldersDeleteRecursive;
use OpenCompany\Integrations\GoogleCloudStorage\Tools\GoogleCloudStorageFoldersGet;
use OpenCompany\Integrations\GoogleCloudStorage\Tools\GoogleCloudStorageFoldersInsert;
use OpenCompany\Integrations\GoogleCloudStorage\Tools\GoogleCloudStorageFoldersList;
use OpenCompany\Integrations\GoogleCloudStorage\Tools\GoogleCloudStorageFoldersRename;
use OpenCompany\Integrations\GoogleCloudStorage\Tools\GoogleCloudStorageManagedFoldersDelete;
use OpenCompany\Integrations\GoogleCloudStorage\Tools\GoogleCloudStorageManagedFoldersGet;
use OpenCompany\Integrations\GoogleCloudStorage\Tools\GoogleCloudStorageManagedFoldersGetIamPolicy;
use OpenCompany\Integrations\GoogleCloudStorage\Tools\GoogleCloudStorageManagedFoldersInsert;
use OpenCompany\Integrations\GoogleCloudStorage\Tools\GoogleCloudStorageManagedFoldersList;
use OpenCompany\Integrations\GoogleCloudStorage\Tools\GoogleCloudStorageManagedFoldersSetIamPolicy;
use OpenCompany\Integrations\GoogleCloudStorage\Tools\GoogleCloudStorageManagedFoldersTestIamPermissions;
use OpenCompany\Integrations\GoogleCloudStorage\Tools\GoogleCloudStorageNotificationsDelete;
use OpenCompany\Integrations\GoogleCloudStorage\Tools\GoogleCloudStorageNotificationsGet;
use OpenCompany\Integrations\GoogleCloudStorage\Tools\GoogleCloudStorageNotificationsInsert;
use OpenCompany\Integrations\GoogleCloudStorage\Tools\GoogleCloudStorageNotificationsList;
use OpenCompany\Integrations\GoogleCloudStorage\Tools\GoogleCloudStorageObjectAccessControlsDelete;
use OpenCompany\Integrations\GoogleCloudStorage\Tools\GoogleCloudStorageObjectAccessControlsGet;
use OpenCompany\Integrations\GoogleCloudStorage\Tools\GoogleCloudStorageObjectAccessControlsInsert;
use OpenCompany\Integrations\GoogleCloudStorage\Tools\GoogleCloudStorageObjectAccessControlsList;
use OpenCompany\Integrations\GoogleCloudStorage\Tools\GoogleCloudStorageObjectAccessControlsPatch;
use OpenCompany\Integrations\GoogleCloudStorage\Tools\GoogleCloudStorageObjectAccessControlsUpdate;
use OpenCompany\Integrations\GoogleCloudStorage\Tools\GoogleCloudStorageObjectsCompose;
use OpenCompany\Integrations\GoogleCloudStorage\Tools\GoogleCloudStorageObjectsCopy;
use OpenCompany\Integrations\GoogleCloudStorage\Tools\GoogleCloudStorageObjectsDelete;
use OpenCompany\Integrations\GoogleCloudStorage\Tools\GoogleCloudStorageObjectsGet;
use OpenCompany\Integrations\GoogleCloudStorage\Tools\GoogleCloudStorageObjectsGetIamPolicy;
use OpenCompany\Integrations\GoogleCloudStorage\Tools\GoogleCloudStorageObjectsInsert;
use OpenCompany\Integrations\GoogleCloudStorage\Tools\GoogleCloudStorageObjectsList;
use OpenCompany\Integrations\GoogleCloudStorage\Tools\GoogleCloudStorageObjectsPatch;
use OpenCompany\Integrations\GoogleCloudStorage\Tools\GoogleCloudStorageObjectsRewrite;
use OpenCompany\Integrations\GoogleCloudStorage\Tools\GoogleCloudStorageObjectsMove;
use OpenCompany\Integrations\GoogleCloudStorage\Tools\GoogleCloudStorageObjectsSetIamPolicy;
use OpenCompany\Integrations\GoogleCloudStorage\Tools\GoogleCloudStorageObjectsTestIamPermissions;
use OpenCompany\Integrations\GoogleCloudStorage\Tools\GoogleCloudStorageObjectsUpdate;
use OpenCompany\Integrations\GoogleCloudStorage\Tools\GoogleCloudStorageObjectsWatchAll;
use OpenCompany\Integrations\GoogleCloudStorage\Tools\GoogleCloudStorageObjectsRestore;
use OpenCompany\Integrations\GoogleCloudStorage\Tools\GoogleCloudStorageObjectsBulkRestore;
use OpenCompany\Integrations\GoogleCloudStorage\Tools\GoogleCloudStorageProjectsHmacKeysCreate;
use OpenCompany\Integrations\GoogleCloudStorage\Tools\GoogleCloudStorageProjectsHmacKeysDelete;
use OpenCompany\Integrations\GoogleCloudStorage\Tools\GoogleCloudStorageProjectsHmacKeysGet;
use OpenCompany\Integrations\GoogleCloudStorage\Tools\GoogleCloudStorageProjectsHmacKeysList;
use OpenCompany\Integrations\GoogleCloudStorage\Tools\GoogleCloudStorageProjectsHmacKeysUpdate;
use OpenCompany\Integrations\GoogleCloudStorage\Tools\GoogleCloudStorageProjectsServiceAccountGet;

/**
 * Tool catalog and configuration metadata for Google Cloud Storage.
 *
 * Exposes generated coverage for the official Cloud Storage v1 Discovery
 * document, including buckets, objects, ACLs, IAM, folders, notifications,
 * operations, HMAC keys, and media upload operations.
 */
class GoogleCloudStorageToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    /**
     * Describe host and authentication capabilities for catalog and setup flows.
     *
     * @return array<string, mixed>
     */
    public function integrationCapabilities(): array
    {
        return [
            'auth' => [
                'strategy' => 'oauth2_manual_token',
                'legacy_auth_type' => 'oauth',
                'credential_mode' => 'stored_token',
                'setup_flows' => ['manual_token'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => ['access_token'],
                'notes' => ['Requires a Google OAuth access token with Cloud Storage scopes such as https://www.googleapis.com/auth/devstorage.full_control.'],
            ],
            'host_availability' => [
                'web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_token'],
                'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_token', 'runtime_mode' => 'normal'],
            ],
            'runtime_requirements' => [],
            'compatibility' => ['web_setup_supported' => true, 'web_runtime_supported' => true, 'cli_setup_supported' => true, 'cli_runtime_supported' => true],
        ];
    }

    public function appName(): string { return 'google-cloud-storage'; }

    public function appMeta(): array
    {
        return ['label' => 'Google Cloud Storage', 'description' => 'Buckets, objects, folders, ACLs, IAM, notifications, and HMAC keys', 'icon' => 'ph:cloud', 'logo' => 'logos:google-cloud'];
    }

    public function integrationMeta(): array
    {
        return ['name' => 'Google Cloud Storage', 'description' => 'Generated coverage for the Cloud Storage JSON API: buckets, objects, ACLs, IAM, folders, managed folders, notifications, operations, HMAC keys, and media uploads.', 'icon' => 'ph:cloud', 'logo' => 'logos:google-cloud', 'category' => 'data', 'badge' => 'verified', 'docs_url' => 'https://cloud.google.com/storage/docs/json_api/v1'];
    }

    public function configSchema(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'placeholder' => 'Google OAuth access token', 'hint' => 'Use a Google OAuth 2.0 token with Cloud Storage scopes.', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'placeholder' => 'https://storage.googleapis.com/storage/v1', 'hint' => 'Override only for a proxy or compatible endpoint.', 'default' => 'https://storage.googleapis.com/storage/v1'],
        ];
    }

    /**
     * Verify Google Cloud Storage credentials with a lightweight bucket list call.
     *
     * @param  array<string, mixed>  $config  Credential and endpoint settings.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = (string) ($config['access_token'] ?? '');
        $baseUrl = rtrim((string) ($config['url'] ?? 'https://storage.googleapis.com/storage/v1'), '/');
        $project = (string) ($config['project'] ?? '');
        if ($accessToken === '') return ['success' => false, 'error' => 'No access token provided.'];
        try {
            $query = $project !== '' ? ['project' => $project, 'maxResults' => 1] : ['maxResults' => 1];
            $response = Http::withHeaders(['Authorization' => 'Bearer ' . $accessToken, 'Accept' => 'application/json'])->timeout(10)->get($baseUrl . '/b', $query);
            if (!$response->successful()) return ['success' => false, 'error' => 'Cloud Storage API returned HTTP ' . $response->status() . '.'];
            return ['success' => true, 'message' => "Connected to Google Cloud Storage at {$baseUrl}."];
        } catch (\Throwable $e) { return ['success' => false, 'error' => $e->getMessage()]; }
    }

    public function validationRules(): array { return ['access_token' => 'nullable|string', 'url' => 'nullable|url']; }

    public function tools(): array
    {
        return [            'google_cloud_storage_anywhere_caches_insert' => ['class' => GoogleCloudStorageAnywhereCachesInsert::class, 'type' => 'write', 'name' => 'Anywhere Caches Insert', 'description' => 'Anywhere Caches Insert (POST /b/{bucket}/anywhereCaches).', 'icon' => 'ph:cloud-arrow-up'],
            'google_cloud_storage_anywhere_caches_update' => ['class' => GoogleCloudStorageAnywhereCachesUpdate::class, 'type' => 'write', 'name' => 'Anywhere Caches Update', 'description' => 'Anywhere Caches Update (PATCH /b/{bucket}/anywhereCaches/{anywhereCacheId}).', 'icon' => 'ph:cloud-arrow-up'],
            'google_cloud_storage_anywhere_caches_get' => ['class' => GoogleCloudStorageAnywhereCachesGet::class, 'type' => 'read', 'name' => 'Anywhere Caches Get', 'description' => 'Anywhere Caches Get (GET /b/{bucket}/anywhereCaches/{anywhereCacheId}).', 'icon' => 'ph:magnifying-glass'],
            'google_cloud_storage_anywhere_caches_list' => ['class' => GoogleCloudStorageAnywhereCachesList::class, 'type' => 'read', 'name' => 'Anywhere Caches List', 'description' => 'Anywhere Caches List (GET /b/{bucket}/anywhereCaches).', 'icon' => 'ph:magnifying-glass'],
            'google_cloud_storage_anywhere_caches_pause' => ['class' => GoogleCloudStorageAnywhereCachesPause::class, 'type' => 'write', 'name' => 'Anywhere Caches Pause', 'description' => 'Anywhere Caches Pause (POST /b/{bucket}/anywhereCaches/{anywhereCacheId}/pause).', 'icon' => 'ph:cloud-arrow-up'],
            'google_cloud_storage_anywhere_caches_resume' => ['class' => GoogleCloudStorageAnywhereCachesResume::class, 'type' => 'write', 'name' => 'Anywhere Caches Resume', 'description' => 'Anywhere Caches Resume (POST /b/{bucket}/anywhereCaches/{anywhereCacheId}/resume).', 'icon' => 'ph:cloud-arrow-up'],
            'google_cloud_storage_anywhere_caches_disable' => ['class' => GoogleCloudStorageAnywhereCachesDisable::class, 'type' => 'write', 'name' => 'Anywhere Caches Disable', 'description' => 'Anywhere Caches Disable (POST /b/{bucket}/anywhereCaches/{anywhereCacheId}/disable).', 'icon' => 'ph:cloud-arrow-up'],
            'google_cloud_storage_bucket_access_controls_delete' => ['class' => GoogleCloudStorageBucketAccessControlsDelete::class, 'type' => 'write', 'name' => 'Bucket Access Controls Delete', 'description' => 'Bucket Access Controls Delete (DELETE /b/{bucket}/acl/{entity}).', 'icon' => 'ph:cloud-arrow-up'],
            'google_cloud_storage_bucket_access_controls_get' => ['class' => GoogleCloudStorageBucketAccessControlsGet::class, 'type' => 'read', 'name' => 'Bucket Access Controls Get', 'description' => 'Bucket Access Controls Get (GET /b/{bucket}/acl/{entity}).', 'icon' => 'ph:magnifying-glass'],
            'google_cloud_storage_bucket_access_controls_insert' => ['class' => GoogleCloudStorageBucketAccessControlsInsert::class, 'type' => 'write', 'name' => 'Bucket Access Controls Insert', 'description' => 'Bucket Access Controls Insert (POST /b/{bucket}/acl).', 'icon' => 'ph:cloud-arrow-up'],
            'google_cloud_storage_bucket_access_controls_list' => ['class' => GoogleCloudStorageBucketAccessControlsList::class, 'type' => 'read', 'name' => 'Bucket Access Controls List', 'description' => 'Bucket Access Controls List (GET /b/{bucket}/acl).', 'icon' => 'ph:magnifying-glass'],
            'google_cloud_storage_bucket_access_controls_patch' => ['class' => GoogleCloudStorageBucketAccessControlsPatch::class, 'type' => 'write', 'name' => 'Bucket Access Controls Patch', 'description' => 'Bucket Access Controls Patch (PATCH /b/{bucket}/acl/{entity}).', 'icon' => 'ph:cloud-arrow-up'],
            'google_cloud_storage_bucket_access_controls_update' => ['class' => GoogleCloudStorageBucketAccessControlsUpdate::class, 'type' => 'write', 'name' => 'Bucket Access Controls Update', 'description' => 'Bucket Access Controls Update (PUT /b/{bucket}/acl/{entity}).', 'icon' => 'ph:cloud-arrow-up'],
            'google_cloud_storage_buckets_delete' => ['class' => GoogleCloudStorageBucketsDelete::class, 'type' => 'write', 'name' => 'Buckets Delete', 'description' => 'Buckets Delete (DELETE /b/{bucket}).', 'icon' => 'ph:cloud-arrow-up'],
            'google_cloud_storage_buckets_restore' => ['class' => GoogleCloudStorageBucketsRestore::class, 'type' => 'write', 'name' => 'Buckets Restore', 'description' => 'Buckets Restore (POST /b/{bucket}/restore).', 'icon' => 'ph:cloud-arrow-up'],
            'google_cloud_storage_buckets_relocate' => ['class' => GoogleCloudStorageBucketsRelocate::class, 'type' => 'write', 'name' => 'Buckets Relocate', 'description' => 'Buckets Relocate (POST /b/{bucket}/relocate).', 'icon' => 'ph:cloud-arrow-up'],
            'google_cloud_storage_buckets_get' => ['class' => GoogleCloudStorageBucketsGet::class, 'type' => 'read', 'name' => 'Buckets Get', 'description' => 'Buckets Get (GET /b/{bucket}).', 'icon' => 'ph:magnifying-glass'],
            'google_cloud_storage_buckets_get_iam_policy' => ['class' => GoogleCloudStorageBucketsGetIamPolicy::class, 'type' => 'read', 'name' => 'Buckets Get Iam Policy', 'description' => 'Buckets Get Iam Policy (GET /b/{bucket}/iam).', 'icon' => 'ph:magnifying-glass'],
            'google_cloud_storage_buckets_get_storage_layout' => ['class' => GoogleCloudStorageBucketsGetStorageLayout::class, 'type' => 'read', 'name' => 'Buckets Get Storage Layout', 'description' => 'Buckets Get Storage Layout (GET /b/{bucket}/storageLayout).', 'icon' => 'ph:magnifying-glass'],
            'google_cloud_storage_buckets_insert' => ['class' => GoogleCloudStorageBucketsInsert::class, 'type' => 'write', 'name' => 'Buckets Insert', 'description' => 'Buckets Insert (POST /b).', 'icon' => 'ph:cloud-arrow-up'],
            'google_cloud_storage_buckets_list' => ['class' => GoogleCloudStorageBucketsList::class, 'type' => 'read', 'name' => 'Buckets List', 'description' => 'Buckets List (GET /b).', 'icon' => 'ph:magnifying-glass'],
            'google_cloud_storage_buckets_lock_retention_policy' => ['class' => GoogleCloudStorageBucketsLockRetentionPolicy::class, 'type' => 'write', 'name' => 'Buckets Lock Retention Policy', 'description' => 'Buckets Lock Retention Policy (POST /b/{bucket}/lockRetentionPolicy).', 'icon' => 'ph:cloud-arrow-up'],
            'google_cloud_storage_buckets_patch' => ['class' => GoogleCloudStorageBucketsPatch::class, 'type' => 'write', 'name' => 'Buckets Patch', 'description' => 'Buckets Patch (PATCH /b/{bucket}).', 'icon' => 'ph:cloud-arrow-up'],
            'google_cloud_storage_buckets_set_iam_policy' => ['class' => GoogleCloudStorageBucketsSetIamPolicy::class, 'type' => 'write', 'name' => 'Buckets Set Iam Policy', 'description' => 'Buckets Set Iam Policy (PUT /b/{bucket}/iam).', 'icon' => 'ph:cloud-arrow-up'],
            'google_cloud_storage_buckets_test_iam_permissions' => ['class' => GoogleCloudStorageBucketsTestIamPermissions::class, 'type' => 'read', 'name' => 'Buckets Test Iam Permissions', 'description' => 'Buckets Test Iam Permissions (GET /b/{bucket}/iam/testPermissions).', 'icon' => 'ph:magnifying-glass'],
            'google_cloud_storage_buckets_update' => ['class' => GoogleCloudStorageBucketsUpdate::class, 'type' => 'write', 'name' => 'Buckets Update', 'description' => 'Buckets Update (PUT /b/{bucket}).', 'icon' => 'ph:cloud-arrow-up'],
            'google_cloud_storage_operations_cancel' => ['class' => GoogleCloudStorageOperationsCancel::class, 'type' => 'write', 'name' => 'Operations Cancel', 'description' => 'Operations Cancel (POST /b/{bucket}/operations/{operationId}/cancel).', 'icon' => 'ph:cloud-arrow-up'],
            'google_cloud_storage_operations_get' => ['class' => GoogleCloudStorageOperationsGet::class, 'type' => 'read', 'name' => 'Operations Get', 'description' => 'Operations Get (GET /b/{bucket}/operations/{operationId}).', 'icon' => 'ph:magnifying-glass'],
            'google_cloud_storage_operations_advance_relocate_bucket' => ['class' => GoogleCloudStorageOperationsAdvanceRelocateBucket::class, 'type' => 'write', 'name' => 'Operations Advance Relocate Bucket', 'description' => 'Operations Advance Relocate Bucket (POST /b/{bucket}/operations/{operationId}/advanceRelocateBucket).', 'icon' => 'ph:cloud-arrow-up'],
            'google_cloud_storage_operations_list' => ['class' => GoogleCloudStorageOperationsList::class, 'type' => 'read', 'name' => 'Operations List', 'description' => 'Operations List (GET /b/{bucket}/operations).', 'icon' => 'ph:magnifying-glass'],
            'google_cloud_storage_channels_stop' => ['class' => GoogleCloudStorageChannelsStop::class, 'type' => 'write', 'name' => 'Channels Stop', 'description' => 'Channels Stop (POST /channels/stop).', 'icon' => 'ph:cloud-arrow-up'],
            'google_cloud_storage_default_object_access_controls_delete' => ['class' => GoogleCloudStorageDefaultObjectAccessControlsDelete::class, 'type' => 'write', 'name' => 'Default Object Access Controls Delete', 'description' => 'Default Object Access Controls Delete (DELETE /b/{bucket}/defaultObjectAcl/{entity}).', 'icon' => 'ph:cloud-arrow-up'],
            'google_cloud_storage_default_object_access_controls_get' => ['class' => GoogleCloudStorageDefaultObjectAccessControlsGet::class, 'type' => 'read', 'name' => 'Default Object Access Controls Get', 'description' => 'Default Object Access Controls Get (GET /b/{bucket}/defaultObjectAcl/{entity}).', 'icon' => 'ph:magnifying-glass'],
            'google_cloud_storage_default_object_access_controls_insert' => ['class' => GoogleCloudStorageDefaultObjectAccessControlsInsert::class, 'type' => 'write', 'name' => 'Default Object Access Controls Insert', 'description' => 'Default Object Access Controls Insert (POST /b/{bucket}/defaultObjectAcl).', 'icon' => 'ph:cloud-arrow-up'],
            'google_cloud_storage_default_object_access_controls_list' => ['class' => GoogleCloudStorageDefaultObjectAccessControlsList::class, 'type' => 'read', 'name' => 'Default Object Access Controls List', 'description' => 'Default Object Access Controls List (GET /b/{bucket}/defaultObjectAcl).', 'icon' => 'ph:magnifying-glass'],
            'google_cloud_storage_default_object_access_controls_patch' => ['class' => GoogleCloudStorageDefaultObjectAccessControlsPatch::class, 'type' => 'write', 'name' => 'Default Object Access Controls Patch', 'description' => 'Default Object Access Controls Patch (PATCH /b/{bucket}/defaultObjectAcl/{entity}).', 'icon' => 'ph:cloud-arrow-up'],
            'google_cloud_storage_default_object_access_controls_update' => ['class' => GoogleCloudStorageDefaultObjectAccessControlsUpdate::class, 'type' => 'write', 'name' => 'Default Object Access Controls Update', 'description' => 'Default Object Access Controls Update (PUT /b/{bucket}/defaultObjectAcl/{entity}).', 'icon' => 'ph:cloud-arrow-up'],
            'google_cloud_storage_folders_delete' => ['class' => GoogleCloudStorageFoldersDelete::class, 'type' => 'write', 'name' => 'Folders Delete', 'description' => 'Folders Delete (DELETE /b/{bucket}/folders/{folder}).', 'icon' => 'ph:cloud-arrow-up'],
            'google_cloud_storage_folders_delete_recursive' => ['class' => GoogleCloudStorageFoldersDeleteRecursive::class, 'type' => 'write', 'name' => 'Folders Delete Recursive', 'description' => 'Folders Delete Recursive (POST /b/{bucket}/folders/{folder}/deleteRecursive).', 'icon' => 'ph:cloud-arrow-up'],
            'google_cloud_storage_folders_get' => ['class' => GoogleCloudStorageFoldersGet::class, 'type' => 'read', 'name' => 'Folders Get', 'description' => 'Folders Get (GET /b/{bucket}/folders/{folder}).', 'icon' => 'ph:magnifying-glass'],
            'google_cloud_storage_folders_insert' => ['class' => GoogleCloudStorageFoldersInsert::class, 'type' => 'write', 'name' => 'Folders Insert', 'description' => 'Folders Insert (POST /b/{bucket}/folders).', 'icon' => 'ph:cloud-arrow-up'],
            'google_cloud_storage_folders_list' => ['class' => GoogleCloudStorageFoldersList::class, 'type' => 'read', 'name' => 'Folders List', 'description' => 'Folders List (GET /b/{bucket}/folders).', 'icon' => 'ph:magnifying-glass'],
            'google_cloud_storage_folders_rename' => ['class' => GoogleCloudStorageFoldersRename::class, 'type' => 'write', 'name' => 'Folders Rename', 'description' => 'Folders Rename (POST /b/{bucket}/folders/{sourceFolder}/renameTo/folders/{destinationFolder}).', 'icon' => 'ph:cloud-arrow-up'],
            'google_cloud_storage_managed_folders_delete' => ['class' => GoogleCloudStorageManagedFoldersDelete::class, 'type' => 'write', 'name' => 'Managed Folders Delete', 'description' => 'Managed Folders Delete (DELETE /b/{bucket}/managedFolders/{managedFolder}).', 'icon' => 'ph:cloud-arrow-up'],
            'google_cloud_storage_managed_folders_get' => ['class' => GoogleCloudStorageManagedFoldersGet::class, 'type' => 'read', 'name' => 'Managed Folders Get', 'description' => 'Managed Folders Get (GET /b/{bucket}/managedFolders/{managedFolder}).', 'icon' => 'ph:magnifying-glass'],
            'google_cloud_storage_managed_folders_get_iam_policy' => ['class' => GoogleCloudStorageManagedFoldersGetIamPolicy::class, 'type' => 'read', 'name' => 'Managed Folders Get Iam Policy', 'description' => 'Managed Folders Get Iam Policy (GET /b/{bucket}/managedFolders/{managedFolder}/iam).', 'icon' => 'ph:magnifying-glass'],
            'google_cloud_storage_managed_folders_insert' => ['class' => GoogleCloudStorageManagedFoldersInsert::class, 'type' => 'write', 'name' => 'Managed Folders Insert', 'description' => 'Managed Folders Insert (POST /b/{bucket}/managedFolders).', 'icon' => 'ph:cloud-arrow-up'],
            'google_cloud_storage_managed_folders_list' => ['class' => GoogleCloudStorageManagedFoldersList::class, 'type' => 'read', 'name' => 'Managed Folders List', 'description' => 'Managed Folders List (GET /b/{bucket}/managedFolders).', 'icon' => 'ph:magnifying-glass'],
            'google_cloud_storage_managed_folders_set_iam_policy' => ['class' => GoogleCloudStorageManagedFoldersSetIamPolicy::class, 'type' => 'write', 'name' => 'Managed Folders Set Iam Policy', 'description' => 'Managed Folders Set Iam Policy (PUT /b/{bucket}/managedFolders/{managedFolder}/iam).', 'icon' => 'ph:cloud-arrow-up'],
            'google_cloud_storage_managed_folders_test_iam_permissions' => ['class' => GoogleCloudStorageManagedFoldersTestIamPermissions::class, 'type' => 'read', 'name' => 'Managed Folders Test Iam Permissions', 'description' => 'Managed Folders Test Iam Permissions (GET /b/{bucket}/managedFolders/{managedFolder}/iam/testPermissions).', 'icon' => 'ph:magnifying-glass'],
            'google_cloud_storage_notifications_delete' => ['class' => GoogleCloudStorageNotificationsDelete::class, 'type' => 'write', 'name' => 'Notifications Delete', 'description' => 'Notifications Delete (DELETE /b/{bucket}/notificationConfigs/{notification}).', 'icon' => 'ph:cloud-arrow-up'],
            'google_cloud_storage_notifications_get' => ['class' => GoogleCloudStorageNotificationsGet::class, 'type' => 'read', 'name' => 'Notifications Get', 'description' => 'Notifications Get (GET /b/{bucket}/notificationConfigs/{notification}).', 'icon' => 'ph:magnifying-glass'],
            'google_cloud_storage_notifications_insert' => ['class' => GoogleCloudStorageNotificationsInsert::class, 'type' => 'write', 'name' => 'Notifications Insert', 'description' => 'Notifications Insert (POST /b/{bucket}/notificationConfigs).', 'icon' => 'ph:cloud-arrow-up'],
            'google_cloud_storage_notifications_list' => ['class' => GoogleCloudStorageNotificationsList::class, 'type' => 'read', 'name' => 'Notifications List', 'description' => 'Notifications List (GET /b/{bucket}/notificationConfigs).', 'icon' => 'ph:magnifying-glass'],
            'google_cloud_storage_object_access_controls_delete' => ['class' => GoogleCloudStorageObjectAccessControlsDelete::class, 'type' => 'write', 'name' => 'Object Access Controls Delete', 'description' => 'Object Access Controls Delete (DELETE /b/{bucket}/o/{object}/acl/{entity}).', 'icon' => 'ph:cloud-arrow-up'],
            'google_cloud_storage_object_access_controls_get' => ['class' => GoogleCloudStorageObjectAccessControlsGet::class, 'type' => 'read', 'name' => 'Object Access Controls Get', 'description' => 'Object Access Controls Get (GET /b/{bucket}/o/{object}/acl/{entity}).', 'icon' => 'ph:magnifying-glass'],
            'google_cloud_storage_object_access_controls_insert' => ['class' => GoogleCloudStorageObjectAccessControlsInsert::class, 'type' => 'write', 'name' => 'Object Access Controls Insert', 'description' => 'Object Access Controls Insert (POST /b/{bucket}/o/{object}/acl).', 'icon' => 'ph:cloud-arrow-up'],
            'google_cloud_storage_object_access_controls_list' => ['class' => GoogleCloudStorageObjectAccessControlsList::class, 'type' => 'read', 'name' => 'Object Access Controls List', 'description' => 'Object Access Controls List (GET /b/{bucket}/o/{object}/acl).', 'icon' => 'ph:magnifying-glass'],
            'google_cloud_storage_object_access_controls_patch' => ['class' => GoogleCloudStorageObjectAccessControlsPatch::class, 'type' => 'write', 'name' => 'Object Access Controls Patch', 'description' => 'Object Access Controls Patch (PATCH /b/{bucket}/o/{object}/acl/{entity}).', 'icon' => 'ph:cloud-arrow-up'],
            'google_cloud_storage_object_access_controls_update' => ['class' => GoogleCloudStorageObjectAccessControlsUpdate::class, 'type' => 'write', 'name' => 'Object Access Controls Update', 'description' => 'Object Access Controls Update (PUT /b/{bucket}/o/{object}/acl/{entity}).', 'icon' => 'ph:cloud-arrow-up'],
            'google_cloud_storage_objects_compose' => ['class' => GoogleCloudStorageObjectsCompose::class, 'type' => 'write', 'name' => 'Objects Compose', 'description' => 'Objects Compose (POST /b/{destinationBucket}/o/{destinationObject}/compose).', 'icon' => 'ph:cloud-arrow-up'],
            'google_cloud_storage_objects_copy' => ['class' => GoogleCloudStorageObjectsCopy::class, 'type' => 'write', 'name' => 'Objects Copy', 'description' => 'Objects Copy (POST /b/{sourceBucket}/o/{sourceObject}/copyTo/b/{destinationBucket}/o/{destinationObject}).', 'icon' => 'ph:cloud-arrow-up'],
            'google_cloud_storage_objects_delete' => ['class' => GoogleCloudStorageObjectsDelete::class, 'type' => 'write', 'name' => 'Objects Delete', 'description' => 'Objects Delete (DELETE /b/{bucket}/o/{object}).', 'icon' => 'ph:cloud-arrow-up'],
            'google_cloud_storage_objects_get' => ['class' => GoogleCloudStorageObjectsGet::class, 'type' => 'read', 'name' => 'Objects Get', 'description' => 'Objects Get (GET /b/{bucket}/o/{object}).', 'icon' => 'ph:magnifying-glass'],
            'google_cloud_storage_objects_get_iam_policy' => ['class' => GoogleCloudStorageObjectsGetIamPolicy::class, 'type' => 'read', 'name' => 'Objects Get Iam Policy', 'description' => 'Objects Get Iam Policy (GET /b/{bucket}/o/{object}/iam).', 'icon' => 'ph:magnifying-glass'],
            'google_cloud_storage_objects_insert' => ['class' => GoogleCloudStorageObjectsInsert::class, 'type' => 'write', 'name' => 'Objects Insert', 'description' => 'Objects Insert (POST /b/{bucket}/o).', 'icon' => 'ph:cloud-arrow-up'],
            'google_cloud_storage_objects_list' => ['class' => GoogleCloudStorageObjectsList::class, 'type' => 'read', 'name' => 'Objects List', 'description' => 'Objects List (GET /b/{bucket}/o).', 'icon' => 'ph:magnifying-glass'],
            'google_cloud_storage_objects_patch' => ['class' => GoogleCloudStorageObjectsPatch::class, 'type' => 'write', 'name' => 'Objects Patch', 'description' => 'Objects Patch (PATCH /b/{bucket}/o/{object}).', 'icon' => 'ph:cloud-arrow-up'],
            'google_cloud_storage_objects_rewrite' => ['class' => GoogleCloudStorageObjectsRewrite::class, 'type' => 'write', 'name' => 'Objects Rewrite', 'description' => 'Objects Rewrite (POST /b/{sourceBucket}/o/{sourceObject}/rewriteTo/b/{destinationBucket}/o/{destinationObject}).', 'icon' => 'ph:cloud-arrow-up'],
            'google_cloud_storage_objects_move' => ['class' => GoogleCloudStorageObjectsMove::class, 'type' => 'write', 'name' => 'Objects Move', 'description' => 'Objects Move (POST /b/{bucket}/o/{sourceObject}/moveTo/o/{destinationObject}).', 'icon' => 'ph:cloud-arrow-up'],
            'google_cloud_storage_objects_set_iam_policy' => ['class' => GoogleCloudStorageObjectsSetIamPolicy::class, 'type' => 'write', 'name' => 'Objects Set Iam Policy', 'description' => 'Objects Set Iam Policy (PUT /b/{bucket}/o/{object}/iam).', 'icon' => 'ph:cloud-arrow-up'],
            'google_cloud_storage_objects_test_iam_permissions' => ['class' => GoogleCloudStorageObjectsTestIamPermissions::class, 'type' => 'read', 'name' => 'Objects Test Iam Permissions', 'description' => 'Objects Test Iam Permissions (GET /b/{bucket}/o/{object}/iam/testPermissions).', 'icon' => 'ph:magnifying-glass'],
            'google_cloud_storage_objects_update' => ['class' => GoogleCloudStorageObjectsUpdate::class, 'type' => 'write', 'name' => 'Objects Update', 'description' => 'Objects Update (PUT /b/{bucket}/o/{object}).', 'icon' => 'ph:cloud-arrow-up'],
            'google_cloud_storage_objects_watch_all' => ['class' => GoogleCloudStorageObjectsWatchAll::class, 'type' => 'write', 'name' => 'Objects Watch All', 'description' => 'Objects Watch All (POST /b/{bucket}/o/watch).', 'icon' => 'ph:cloud-arrow-up'],
            'google_cloud_storage_objects_restore' => ['class' => GoogleCloudStorageObjectsRestore::class, 'type' => 'write', 'name' => 'Objects Restore', 'description' => 'Objects Restore (POST /b/{bucket}/o/{object}/restore).', 'icon' => 'ph:cloud-arrow-up'],
            'google_cloud_storage_objects_bulk_restore' => ['class' => GoogleCloudStorageObjectsBulkRestore::class, 'type' => 'write', 'name' => 'Objects Bulk Restore', 'description' => 'Objects Bulk Restore (POST /b/{bucket}/o/bulkRestore).', 'icon' => 'ph:cloud-arrow-up'],
            'google_cloud_storage_projects_hmac_keys_create' => ['class' => GoogleCloudStorageProjectsHmacKeysCreate::class, 'type' => 'write', 'name' => 'Projects Hmac Keys Create', 'description' => 'Projects Hmac Keys Create (POST /projects/{projectId}/hmacKeys).', 'icon' => 'ph:cloud-arrow-up'],
            'google_cloud_storage_projects_hmac_keys_delete' => ['class' => GoogleCloudStorageProjectsHmacKeysDelete::class, 'type' => 'write', 'name' => 'Projects Hmac Keys Delete', 'description' => 'Projects Hmac Keys Delete (DELETE /projects/{projectId}/hmacKeys/{accessId}).', 'icon' => 'ph:cloud-arrow-up'],
            'google_cloud_storage_projects_hmac_keys_get' => ['class' => GoogleCloudStorageProjectsHmacKeysGet::class, 'type' => 'read', 'name' => 'Projects Hmac Keys Get', 'description' => 'Projects Hmac Keys Get (GET /projects/{projectId}/hmacKeys/{accessId}).', 'icon' => 'ph:magnifying-glass'],
            'google_cloud_storage_projects_hmac_keys_list' => ['class' => GoogleCloudStorageProjectsHmacKeysList::class, 'type' => 'read', 'name' => 'Projects Hmac Keys List', 'description' => 'Projects Hmac Keys List (GET /projects/{projectId}/hmacKeys).', 'icon' => 'ph:magnifying-glass'],
            'google_cloud_storage_projects_hmac_keys_update' => ['class' => GoogleCloudStorageProjectsHmacKeysUpdate::class, 'type' => 'write', 'name' => 'Projects Hmac Keys Update', 'description' => 'Projects Hmac Keys Update (PUT /projects/{projectId}/hmacKeys/{accessId}).', 'icon' => 'ph:cloud-arrow-up'],
            'google_cloud_storage_projects_service_account_get' => ['class' => GoogleCloudStorageProjectsServiceAccountGet::class, 'type' => 'read', 'name' => 'Projects Service Account Get', 'description' => 'Projects Service Account Get (GET /projects/{projectId}/serviceAccount).', 'icon' => 'ph:magnifying-glass'],
        ];
    }

    public function credentialFields(): array { return $this->configSchema(); }
    public function isIntegration(): bool { return true; }

    /**
     * Create a Google Cloud Storage tool from the catalog class name.
     *
     * @param  array<string, mixed>  $context  Optional account context.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve a service for the default or named account.
     *
     * @param  array<string, mixed>  $context  Tool creation context.
     */
    private function resolveService(array $context = []): GoogleCloudStorageService
    {
        $account = $context['account'] ?? null;
        if ($account !== null) {
            $creds = app(CredentialResolver::class);
            return new GoogleCloudStorageService(
                accessToken: $creds->get('google-cloud-storage', 'access_token', '', $account),
                baseUrl: $creds->get('google-cloud-storage', 'url', 'https://storage.googleapis.com/storage/v1', $account),
            );
        }
        return app(GoogleCloudStorageService::class);
    }

    public function luaDocsPath(): ?string { return __DIR__ . '/../lua-docs/google-cloud-storage.md'; }
}