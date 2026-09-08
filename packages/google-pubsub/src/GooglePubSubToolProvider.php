<?php

namespace OpenCompany\Integrations\GooglePubSub;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\GooglePubSub\Tools\GooglePubSubProjectsTopicsPublish;
use OpenCompany\Integrations\GooglePubSub\Tools\GooglePubSubProjectsTopicsDelete;
use OpenCompany\Integrations\GooglePubSub\Tools\GooglePubSubProjectsTopicsSetIamPolicy;
use OpenCompany\Integrations\GooglePubSub\Tools\GooglePubSubProjectsTopicsGetIamPolicy;
use OpenCompany\Integrations\GooglePubSub\Tools\GooglePubSubProjectsTopicsTestIamPermissions;
use OpenCompany\Integrations\GooglePubSub\Tools\GooglePubSubProjectsTopicsCreate;
use OpenCompany\Integrations\GooglePubSub\Tools\GooglePubSubProjectsTopicsList;
use OpenCompany\Integrations\GooglePubSub\Tools\GooglePubSubProjectsTopicsPatch;
use OpenCompany\Integrations\GooglePubSub\Tools\GooglePubSubProjectsTopicsGet;
use OpenCompany\Integrations\GooglePubSub\Tools\GooglePubSubProjectsTopicsSubscriptionsList;
use OpenCompany\Integrations\GooglePubSub\Tools\GooglePubSubProjectsTopicsSnapshotsList;
use OpenCompany\Integrations\GooglePubSub\Tools\GooglePubSubProjectsSubscriptionsAcknowledge;
use OpenCompany\Integrations\GooglePubSub\Tools\GooglePubSubProjectsSubscriptionsTestIamPermissions;
use OpenCompany\Integrations\GooglePubSub\Tools\GooglePubSubProjectsSubscriptionsGet;
use OpenCompany\Integrations\GooglePubSub\Tools\GooglePubSubProjectsSubscriptionsPatch;
use OpenCompany\Integrations\GooglePubSub\Tools\GooglePubSubProjectsSubscriptionsSetIamPolicy;
use OpenCompany\Integrations\GooglePubSub\Tools\GooglePubSubProjectsSubscriptionsDetach;
use OpenCompany\Integrations\GooglePubSub\Tools\GooglePubSubProjectsSubscriptionsPull;
use OpenCompany\Integrations\GooglePubSub\Tools\GooglePubSubProjectsSubscriptionsList;
use OpenCompany\Integrations\GooglePubSub\Tools\GooglePubSubProjectsSubscriptionsCreate;
use OpenCompany\Integrations\GooglePubSub\Tools\GooglePubSubProjectsSubscriptionsModifyPushConfig;
use OpenCompany\Integrations\GooglePubSub\Tools\GooglePubSubProjectsSubscriptionsModifyAckDeadline;
use OpenCompany\Integrations\GooglePubSub\Tools\GooglePubSubProjectsSubscriptionsDelete;
use OpenCompany\Integrations\GooglePubSub\Tools\GooglePubSubProjectsSubscriptionsGetIamPolicy;
use OpenCompany\Integrations\GooglePubSub\Tools\GooglePubSubProjectsSubscriptionsSeek;
use OpenCompany\Integrations\GooglePubSub\Tools\GooglePubSubProjectsSnapshotsSetIamPolicy;
use OpenCompany\Integrations\GooglePubSub\Tools\GooglePubSubProjectsSnapshotsGetIamPolicy;
use OpenCompany\Integrations\GooglePubSub\Tools\GooglePubSubProjectsSnapshotsGet;
use OpenCompany\Integrations\GooglePubSub\Tools\GooglePubSubProjectsSnapshotsPatch;
use OpenCompany\Integrations\GooglePubSub\Tools\GooglePubSubProjectsSnapshotsTestIamPermissions;
use OpenCompany\Integrations\GooglePubSub\Tools\GooglePubSubProjectsSnapshotsCreate;
use OpenCompany\Integrations\GooglePubSub\Tools\GooglePubSubProjectsSnapshotsList;
use OpenCompany\Integrations\GooglePubSub\Tools\GooglePubSubProjectsSnapshotsDelete;
use OpenCompany\Integrations\GooglePubSub\Tools\GooglePubSubProjectsSchemasTestIamPermissions;
use OpenCompany\Integrations\GooglePubSub\Tools\GooglePubSubProjectsSchemasValidate;
use OpenCompany\Integrations\GooglePubSub\Tools\GooglePubSubProjectsSchemasRollback;
use OpenCompany\Integrations\GooglePubSub\Tools\GooglePubSubProjectsSchemasGet;
use OpenCompany\Integrations\GooglePubSub\Tools\GooglePubSubProjectsSchemasSetIamPolicy;
use OpenCompany\Integrations\GooglePubSub\Tools\GooglePubSubProjectsSchemasCreate;
use OpenCompany\Integrations\GooglePubSub\Tools\GooglePubSubProjectsSchemasList;
use OpenCompany\Integrations\GooglePubSub\Tools\GooglePubSubProjectsSchemasValidateMessage;
use OpenCompany\Integrations\GooglePubSub\Tools\GooglePubSubProjectsSchemasCommit;
use OpenCompany\Integrations\GooglePubSub\Tools\GooglePubSubProjectsSchemasDelete;
use OpenCompany\Integrations\GooglePubSub\Tools\GooglePubSubProjectsSchemasGetIamPolicy;
use OpenCompany\Integrations\GooglePubSub\Tools\GooglePubSubProjectsSchemasListRevisions;
use OpenCompany\Integrations\GooglePubSub\Tools\GooglePubSubProjectsSchemasDeleteRevision;

/**
 * Tool catalog and configuration metadata for Google Pub/Sub.
 *
 * Exposes generated coverage for the official Pub/Sub v1 Discovery document,
 * including topics, subscriptions, snapshots, schemas, IAM, publishing,
 * pulling, acknowledging, and replay/seek operations.
 */
class GooglePubSubToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    /**
     * Describe host and authentication capabilities for catalog and setup flows.
     *
     * @return array<string, mixed>
     */
    public function integrationCapabilities(): array
    {
        return [
            'auth' => ['strategy' => 'oauth2_manual_token', 'legacy_auth_type' => 'oauth', 'credential_mode' => 'stored_token', 'setup_flows' => ['manual_token'], 'requires_browser_for_setup' => false, 'refreshable' => false, 'token_keys' => ['access_token'], 'notes' => ['Requires a Google OAuth access token with Pub/Sub scopes such as https://www.googleapis.com/auth/pubsub.']],
            'host_availability' => ['web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_token'], 'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_token', 'runtime_mode' => 'normal']],
            'runtime_requirements' => [],
            'compatibility' => ['web_setup_supported' => true, 'web_runtime_supported' => true, 'cli_setup_supported' => true, 'cli_runtime_supported' => true],
        ];
    }

    public function appName(): string { return 'google-pubsub'; }
    public function appMeta(): array { return ['label' => 'Google Pub/Sub', 'description' => 'Topics, subscriptions, messages, snapshots, schemas, and IAM', 'icon' => 'ph:broadcast', 'logo' => 'logos:google-cloud']; }
    public function integrationMeta(): array { return ['name' => 'Google Pub/Sub', 'description' => 'Generated coverage for the Pub/Sub v1 REST API: topics, subscriptions, publish, pull, acknowledge, seek, snapshots, schemas, and IAM.', 'icon' => 'ph:broadcast', 'logo' => 'logos:google-cloud', 'category' => 'data', 'badge' => 'verified', 'docs_url' => 'https://cloud.google.com/pubsub/docs/reference/rest']; }
    public function configSchema(): array { return [['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'placeholder' => 'Google OAuth access token', 'hint' => 'Use a Google OAuth 2.0 token with Pub/Sub scopes.', 'required' => true], ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'placeholder' => 'https://pubsub.googleapis.com', 'hint' => 'Override only for a proxy or compatible endpoint.', 'default' => 'https://pubsub.googleapis.com']]; }

    /**
     * Verify Google Pub/Sub credentials with a lightweight topic list call when project is supplied.
     *
     * @param  array<string, mixed>  $config  Credential and endpoint settings.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = (string) ($config['access_token'] ?? '');
        $baseUrl = rtrim((string) ($config['url'] ?? 'https://pubsub.googleapis.com'), '/');
        $project = (string) ($config['project'] ?? '');
        if ($accessToken === '') return ['success' => false, 'error' => 'No access token provided.'];
        if ($project === '') return ['success' => true, 'message' => 'Google Pub/Sub token is present. Provide a project ID to run a live topic-list credential check.'];
        try {
            $response = Http::withHeaders(['Authorization' => 'Bearer ' . $accessToken, 'Accept' => 'application/json'])->timeout(10)->get($baseUrl . '/v1/projects/' . rawurlencode($project) . '/topics', ['pageSize' => 1]);
            if (!$response->successful()) return ['success' => false, 'error' => 'Pub/Sub API returned HTTP ' . $response->status() . '.'];
            return ['success' => true, 'message' => "Connected to Google Pub/Sub at {$baseUrl}."];
        } catch (\Throwable $e) { return ['success' => false, 'error' => $e->getMessage()]; }
    }

    public function validationRules(): array { return ['access_token' => 'nullable|string', 'url' => 'nullable|url']; }

    public function tools(): array
    {
        return [            'google_pubsub_projects_topics_publish' => ['class' => GooglePubSubProjectsTopicsPublish::class, 'type' => 'write', 'name' => 'Projects Topics Publish', 'description' => 'Projects Topics Publish (POST /v1/{+topic}:publish).', 'icon' => 'ph:broadcast'],
            'google_pubsub_projects_topics_delete' => ['class' => GooglePubSubProjectsTopicsDelete::class, 'type' => 'write', 'name' => 'Projects Topics Delete', 'description' => 'Projects Topics Delete (DELETE /v1/{+topic}).', 'icon' => 'ph:broadcast'],
            'google_pubsub_projects_topics_set_iam_policy' => ['class' => GooglePubSubProjectsTopicsSetIamPolicy::class, 'type' => 'write', 'name' => 'Projects Topics Set Iam Policy', 'description' => 'Projects Topics Set Iam Policy (POST /v1/{+resource}:setIamPolicy).', 'icon' => 'ph:broadcast'],
            'google_pubsub_projects_topics_get_iam_policy' => ['class' => GooglePubSubProjectsTopicsGetIamPolicy::class, 'type' => 'read', 'name' => 'Projects Topics Get Iam Policy', 'description' => 'Projects Topics Get Iam Policy (GET /v1/{+resource}:getIamPolicy).', 'icon' => 'ph:magnifying-glass'],
            'google_pubsub_projects_topics_test_iam_permissions' => ['class' => GooglePubSubProjectsTopicsTestIamPermissions::class, 'type' => 'write', 'name' => 'Projects Topics Test Iam Permissions', 'description' => 'Projects Topics Test Iam Permissions (POST /v1/{+resource}:testIamPermissions).', 'icon' => 'ph:broadcast'],
            'google_pubsub_projects_topics_create' => ['class' => GooglePubSubProjectsTopicsCreate::class, 'type' => 'write', 'name' => 'Projects Topics Create', 'description' => 'Projects Topics Create (PUT /v1/{+name}).', 'icon' => 'ph:broadcast'],
            'google_pubsub_projects_topics_list' => ['class' => GooglePubSubProjectsTopicsList::class, 'type' => 'read', 'name' => 'Projects Topics List', 'description' => 'Projects Topics List (GET /v1/{+project}/topics).', 'icon' => 'ph:magnifying-glass'],
            'google_pubsub_projects_topics_patch' => ['class' => GooglePubSubProjectsTopicsPatch::class, 'type' => 'write', 'name' => 'Projects Topics Patch', 'description' => 'Projects Topics Patch (PATCH /v1/{+name}).', 'icon' => 'ph:broadcast'],
            'google_pubsub_projects_topics_get' => ['class' => GooglePubSubProjectsTopicsGet::class, 'type' => 'read', 'name' => 'Projects Topics Get', 'description' => 'Projects Topics Get (GET /v1/{+topic}).', 'icon' => 'ph:magnifying-glass'],
            'google_pubsub_projects_topics_subscriptions_list' => ['class' => GooglePubSubProjectsTopicsSubscriptionsList::class, 'type' => 'read', 'name' => 'Projects Topics Subscriptions List', 'description' => 'Projects Topics Subscriptions List (GET /v1/{+topic}/subscriptions).', 'icon' => 'ph:magnifying-glass'],
            'google_pubsub_projects_topics_snapshots_list' => ['class' => GooglePubSubProjectsTopicsSnapshotsList::class, 'type' => 'read', 'name' => 'Projects Topics Snapshots List', 'description' => 'Projects Topics Snapshots List (GET /v1/{+topic}/snapshots).', 'icon' => 'ph:magnifying-glass'],
            'google_pubsub_projects_subscriptions_acknowledge' => ['class' => GooglePubSubProjectsSubscriptionsAcknowledge::class, 'type' => 'write', 'name' => 'Projects Subscriptions Acknowledge', 'description' => 'Projects Subscriptions Acknowledge (POST /v1/{+subscription}:acknowledge).', 'icon' => 'ph:broadcast'],
            'google_pubsub_projects_subscriptions_test_iam_permissions' => ['class' => GooglePubSubProjectsSubscriptionsTestIamPermissions::class, 'type' => 'write', 'name' => 'Projects Subscriptions Test Iam Permissions', 'description' => 'Projects Subscriptions Test Iam Permissions (POST /v1/{+resource}:testIamPermissions).', 'icon' => 'ph:broadcast'],
            'google_pubsub_projects_subscriptions_get' => ['class' => GooglePubSubProjectsSubscriptionsGet::class, 'type' => 'read', 'name' => 'Projects Subscriptions Get', 'description' => 'Projects Subscriptions Get (GET /v1/{+subscription}).', 'icon' => 'ph:magnifying-glass'],
            'google_pubsub_projects_subscriptions_patch' => ['class' => GooglePubSubProjectsSubscriptionsPatch::class, 'type' => 'write', 'name' => 'Projects Subscriptions Patch', 'description' => 'Projects Subscriptions Patch (PATCH /v1/{+name}).', 'icon' => 'ph:broadcast'],
            'google_pubsub_projects_subscriptions_set_iam_policy' => ['class' => GooglePubSubProjectsSubscriptionsSetIamPolicy::class, 'type' => 'write', 'name' => 'Projects Subscriptions Set Iam Policy', 'description' => 'Projects Subscriptions Set Iam Policy (POST /v1/{+resource}:setIamPolicy).', 'icon' => 'ph:broadcast'],
            'google_pubsub_projects_subscriptions_detach' => ['class' => GooglePubSubProjectsSubscriptionsDetach::class, 'type' => 'write', 'name' => 'Projects Subscriptions Detach', 'description' => 'Projects Subscriptions Detach (POST /v1/{+subscription}:detach).', 'icon' => 'ph:broadcast'],
            'google_pubsub_projects_subscriptions_pull' => ['class' => GooglePubSubProjectsSubscriptionsPull::class, 'type' => 'write', 'name' => 'Projects Subscriptions Pull', 'description' => 'Projects Subscriptions Pull (POST /v1/{+subscription}:pull).', 'icon' => 'ph:broadcast'],
            'google_pubsub_projects_subscriptions_list' => ['class' => GooglePubSubProjectsSubscriptionsList::class, 'type' => 'read', 'name' => 'Projects Subscriptions List', 'description' => 'Projects Subscriptions List (GET /v1/{+project}/subscriptions).', 'icon' => 'ph:magnifying-glass'],
            'google_pubsub_projects_subscriptions_create' => ['class' => GooglePubSubProjectsSubscriptionsCreate::class, 'type' => 'write', 'name' => 'Projects Subscriptions Create', 'description' => 'Projects Subscriptions Create (PUT /v1/{+name}).', 'icon' => 'ph:broadcast'],
            'google_pubsub_projects_subscriptions_modify_push_config' => ['class' => GooglePubSubProjectsSubscriptionsModifyPushConfig::class, 'type' => 'write', 'name' => 'Projects Subscriptions Modify Push Config', 'description' => 'Projects Subscriptions Modify Push Config (POST /v1/{+subscription}:modifyPushConfig).', 'icon' => 'ph:broadcast'],
            'google_pubsub_projects_subscriptions_modify_ack_deadline' => ['class' => GooglePubSubProjectsSubscriptionsModifyAckDeadline::class, 'type' => 'write', 'name' => 'Projects Subscriptions Modify Ack Deadline', 'description' => 'Projects Subscriptions Modify Ack Deadline (POST /v1/{+subscription}:modifyAckDeadline).', 'icon' => 'ph:broadcast'],
            'google_pubsub_projects_subscriptions_delete' => ['class' => GooglePubSubProjectsSubscriptionsDelete::class, 'type' => 'write', 'name' => 'Projects Subscriptions Delete', 'description' => 'Projects Subscriptions Delete (DELETE /v1/{+subscription}).', 'icon' => 'ph:broadcast'],
            'google_pubsub_projects_subscriptions_get_iam_policy' => ['class' => GooglePubSubProjectsSubscriptionsGetIamPolicy::class, 'type' => 'read', 'name' => 'Projects Subscriptions Get Iam Policy', 'description' => 'Projects Subscriptions Get Iam Policy (GET /v1/{+resource}:getIamPolicy).', 'icon' => 'ph:magnifying-glass'],
            'google_pubsub_projects_subscriptions_seek' => ['class' => GooglePubSubProjectsSubscriptionsSeek::class, 'type' => 'write', 'name' => 'Projects Subscriptions Seek', 'description' => 'Projects Subscriptions Seek (POST /v1/{+subscription}:seek).', 'icon' => 'ph:broadcast'],
            'google_pubsub_projects_snapshots_set_iam_policy' => ['class' => GooglePubSubProjectsSnapshotsSetIamPolicy::class, 'type' => 'write', 'name' => 'Projects Snapshots Set Iam Policy', 'description' => 'Projects Snapshots Set Iam Policy (POST /v1/{+resource}:setIamPolicy).', 'icon' => 'ph:broadcast'],
            'google_pubsub_projects_snapshots_get_iam_policy' => ['class' => GooglePubSubProjectsSnapshotsGetIamPolicy::class, 'type' => 'read', 'name' => 'Projects Snapshots Get Iam Policy', 'description' => 'Projects Snapshots Get Iam Policy (GET /v1/{+resource}:getIamPolicy).', 'icon' => 'ph:magnifying-glass'],
            'google_pubsub_projects_snapshots_get' => ['class' => GooglePubSubProjectsSnapshotsGet::class, 'type' => 'read', 'name' => 'Projects Snapshots Get', 'description' => 'Projects Snapshots Get (GET /v1/{+snapshot}).', 'icon' => 'ph:magnifying-glass'],
            'google_pubsub_projects_snapshots_patch' => ['class' => GooglePubSubProjectsSnapshotsPatch::class, 'type' => 'write', 'name' => 'Projects Snapshots Patch', 'description' => 'Projects Snapshots Patch (PATCH /v1/{+name}).', 'icon' => 'ph:broadcast'],
            'google_pubsub_projects_snapshots_test_iam_permissions' => ['class' => GooglePubSubProjectsSnapshotsTestIamPermissions::class, 'type' => 'write', 'name' => 'Projects Snapshots Test Iam Permissions', 'description' => 'Projects Snapshots Test Iam Permissions (POST /v1/{+resource}:testIamPermissions).', 'icon' => 'ph:broadcast'],
            'google_pubsub_projects_snapshots_create' => ['class' => GooglePubSubProjectsSnapshotsCreate::class, 'type' => 'write', 'name' => 'Projects Snapshots Create', 'description' => 'Projects Snapshots Create (PUT /v1/{+name}).', 'icon' => 'ph:broadcast'],
            'google_pubsub_projects_snapshots_list' => ['class' => GooglePubSubProjectsSnapshotsList::class, 'type' => 'read', 'name' => 'Projects Snapshots List', 'description' => 'Projects Snapshots List (GET /v1/{+project}/snapshots).', 'icon' => 'ph:magnifying-glass'],
            'google_pubsub_projects_snapshots_delete' => ['class' => GooglePubSubProjectsSnapshotsDelete::class, 'type' => 'write', 'name' => 'Projects Snapshots Delete', 'description' => 'Projects Snapshots Delete (DELETE /v1/{+snapshot}).', 'icon' => 'ph:broadcast'],
            'google_pubsub_projects_schemas_test_iam_permissions' => ['class' => GooglePubSubProjectsSchemasTestIamPermissions::class, 'type' => 'write', 'name' => 'Projects Schemas Test Iam Permissions', 'description' => 'Projects Schemas Test Iam Permissions (POST /v1/{+resource}:testIamPermissions).', 'icon' => 'ph:broadcast'],
            'google_pubsub_projects_schemas_validate' => ['class' => GooglePubSubProjectsSchemasValidate::class, 'type' => 'write', 'name' => 'Projects Schemas Validate', 'description' => 'Projects Schemas Validate (POST /v1/{+parent}/schemas:validate).', 'icon' => 'ph:broadcast'],
            'google_pubsub_projects_schemas_rollback' => ['class' => GooglePubSubProjectsSchemasRollback::class, 'type' => 'write', 'name' => 'Projects Schemas Rollback', 'description' => 'Projects Schemas Rollback (POST /v1/{+name}:rollback).', 'icon' => 'ph:broadcast'],
            'google_pubsub_projects_schemas_get' => ['class' => GooglePubSubProjectsSchemasGet::class, 'type' => 'read', 'name' => 'Projects Schemas Get', 'description' => 'Projects Schemas Get (GET /v1/{+name}).', 'icon' => 'ph:magnifying-glass'],
            'google_pubsub_projects_schemas_set_iam_policy' => ['class' => GooglePubSubProjectsSchemasSetIamPolicy::class, 'type' => 'write', 'name' => 'Projects Schemas Set Iam Policy', 'description' => 'Projects Schemas Set Iam Policy (POST /v1/{+resource}:setIamPolicy).', 'icon' => 'ph:broadcast'],
            'google_pubsub_projects_schemas_create' => ['class' => GooglePubSubProjectsSchemasCreate::class, 'type' => 'write', 'name' => 'Projects Schemas Create', 'description' => 'Projects Schemas Create (POST /v1/{+parent}/schemas).', 'icon' => 'ph:broadcast'],
            'google_pubsub_projects_schemas_list' => ['class' => GooglePubSubProjectsSchemasList::class, 'type' => 'read', 'name' => 'Projects Schemas List', 'description' => 'Projects Schemas List (GET /v1/{+parent}/schemas).', 'icon' => 'ph:magnifying-glass'],
            'google_pubsub_projects_schemas_validate_message' => ['class' => GooglePubSubProjectsSchemasValidateMessage::class, 'type' => 'write', 'name' => 'Projects Schemas Validate Message', 'description' => 'Projects Schemas Validate Message (POST /v1/{+parent}/schemas:validateMessage).', 'icon' => 'ph:broadcast'],
            'google_pubsub_projects_schemas_commit' => ['class' => GooglePubSubProjectsSchemasCommit::class, 'type' => 'write', 'name' => 'Projects Schemas Commit', 'description' => 'Projects Schemas Commit (POST /v1/{+name}:commit).', 'icon' => 'ph:broadcast'],
            'google_pubsub_projects_schemas_delete' => ['class' => GooglePubSubProjectsSchemasDelete::class, 'type' => 'write', 'name' => 'Projects Schemas Delete', 'description' => 'Projects Schemas Delete (DELETE /v1/{+name}).', 'icon' => 'ph:broadcast'],
            'google_pubsub_projects_schemas_get_iam_policy' => ['class' => GooglePubSubProjectsSchemasGetIamPolicy::class, 'type' => 'read', 'name' => 'Projects Schemas Get Iam Policy', 'description' => 'Projects Schemas Get Iam Policy (GET /v1/{+resource}:getIamPolicy).', 'icon' => 'ph:magnifying-glass'],
            'google_pubsub_projects_schemas_list_revisions' => ['class' => GooglePubSubProjectsSchemasListRevisions::class, 'type' => 'read', 'name' => 'Projects Schemas List Revisions', 'description' => 'Projects Schemas List Revisions (GET /v1/{+name}:listRevisions).', 'icon' => 'ph:magnifying-glass'],
            'google_pubsub_projects_schemas_delete_revision' => ['class' => GooglePubSubProjectsSchemasDeleteRevision::class, 'type' => 'write', 'name' => 'Projects Schemas Delete Revision', 'description' => 'Projects Schemas Delete Revision (DELETE /v1/{+name}:deleteRevision).', 'icon' => 'ph:broadcast'],
        ];
    }

    public function credentialFields(): array { return $this->configSchema(); }
    public function isIntegration(): bool { return true; }

    /**
     * Create a Google Pub/Sub tool from the catalog class name.
     *
     * @param  array<string, mixed>  $context  Optional account context.
     */
    public function createTool(string $class, array $context = []): Tool { return new $class($this->resolveService($context)); }

    /**
     * Resolve a service for the default or named account.
     *
     * @param  array<string, mixed>  $context  Tool creation context.
     */
    private function resolveService(array $context = []): GooglePubSubService
    {
        $account = $context['account'] ?? null;
        if ($account !== null) {
            $creds = app(CredentialResolver::class);
            return new GooglePubSubService(accessToken: $creds->get('google-pubsub', 'access_token', '', $account), baseUrl: $creds->get('google-pubsub', 'url', 'https://pubsub.googleapis.com', $account));
        }
        return app(GooglePubSubService::class);
    }

    public function scriptDocsPath(): ?string { return __DIR__ . '/../script-docs/google-pubsub.md'; }
}