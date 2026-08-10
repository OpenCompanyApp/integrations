<?php

namespace OpenCompany\Integrations\Tally;

use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Tally\Tools\TallyApiDelete;
use OpenCompany\Integrations\Tally\Tools\TallyApiGet;
use OpenCompany\Integrations\Tally\Tools\TallyApiPatch;
use OpenCompany\Integrations\Tally\Tools\TallyApiPost;
use OpenCompany\Integrations\Tally\Tools\TallyCancelOrganizationInvite;
use OpenCompany\Integrations\Tally\Tools\TallyCreateForm;
use OpenCompany\Integrations\Tally\Tools\TallyCreateOrganizationInvite;
use OpenCompany\Integrations\Tally\Tools\TallyCreateWebhook;
use OpenCompany\Integrations\Tally\Tools\TallyCreateWorkspace;
use OpenCompany\Integrations\Tally\Tools\TallyDeleteForm;
use OpenCompany\Integrations\Tally\Tools\TallyDeleteSubmission;
use OpenCompany\Integrations\Tally\Tools\TallyDeleteWebhook;
use OpenCompany\Integrations\Tally\Tools\TallyDeleteWorkspace;
use OpenCompany\Integrations\Tally\Tools\TallyGetCurrentUser;
use OpenCompany\Integrations\Tally\Tools\TallyGetForm;
use OpenCompany\Integrations\Tally\Tools\TallyGetSubmission;
use OpenCompany\Integrations\Tally\Tools\TallyGetWorkspace;
use OpenCompany\Integrations\Tally\Tools\TallyListBlocks;
use OpenCompany\Integrations\Tally\Tools\TallyListForms;
use OpenCompany\Integrations\Tally\Tools\TallyListOrganizationInvites;
use OpenCompany\Integrations\Tally\Tools\TallyListOrganizationUsers;
use OpenCompany\Integrations\Tally\Tools\TallyListQuestions;
use OpenCompany\Integrations\Tally\Tools\TallyListSubmissions;
use OpenCompany\Integrations\Tally\Tools\TallyListWebhookEvents;
use OpenCompany\Integrations\Tally\Tools\TallyListWebhooks;
use OpenCompany\Integrations\Tally\Tools\TallyListWorkspaces;
use OpenCompany\Integrations\Tally\Tools\TallyRemoveOrganizationUser;
use OpenCompany\Integrations\Tally\Tools\TallyRetryWebhookEvent;
use OpenCompany\Integrations\Tally\Tools\TallyUpdateBlocks;
use OpenCompany\Integrations\Tally\Tools\TallyUpdateForm;
use OpenCompany\Integrations\Tally\Tools\TallyUpdateQuestion;
use OpenCompany\Integrations\Tally\Tools\TallyUpdateWebhook;
use OpenCompany\Integrations\Tally\Tools\TallyUpdateWorkspace;

/**
 * Exposes the Tally integration catalog, credentials, and tool factory.
 */
class TallyToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'strategy' => 'bearer_token',
                'legacy_auth_type' => 'oauth',
                'credential_mode' => 'stored_token',
                'setup_flows' => ['manual_token'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => ['access_token'],
                'notes' => [],
            ],
            'host_availability' => [
                'web' => [
                    'setup_supported' => true,
                    'runtime_supported' => true,
                    'setup_mode' => 'manual_token',
                ],
                'cli' => [
                    'setup_supported' => true,
                    'runtime_supported' => true,
                    'setup_mode' => 'manual_token',
                    'runtime_mode' => 'normal',
                ],
            ],
            'runtime_requirements' => [],
            'compatibility' => [
                'web_setup_supported' => true,
                'web_runtime_supported' => true,
                'cli_setup_supported' => true,
                'cli_runtime_supported' => true,
            ],
        ];
    }

    public function appName(): string
    {
        return 'tally';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Tally',
            'description' => 'Forms, submissions, workspaces, and webhooks',
            'icon' => 'ph:notebook',
            'logo' => 'simple-icons:tally',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Tally',
            'description' => 'Online forms, submissions, workspaces, organization invites, and webhooks',
            'icon' => 'ph:notebook',
            'logo' => 'simple-icons:tally',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://developers.tally.so/api-reference/introduction',
        ];
    }

    public function configSchema(): array
    {
        return $this->credentialFields();
    }

    /**
     * Validate credentials by making a lightweight authenticated request.
     *
     * @param  array<string, mixed>  $config
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        foreach ($this->credentialFields() as $field) {
            if (($field['required'] ?? true) && empty($config[$field['key']])) {
                return [
                    'success' => false,
                    'error' => ($field['label'] ?? $field['key']).' is required.',
                ];
            }
        }

        try {
            $service = new TallyService(
                accessToken: (string) ($config['access_token'] ?? ''),
                baseUrl: (string) (($config['url'] ?? '') ?: 'https://api.tally.so'),
                apiVersion: (string) (($config['api_version'] ?? '') ?: '2026-02-05'),
            );
            $service->getCurrentUser();

            return ['success' => true, 'message' => 'Connected to Tally.'];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'access_token' => 'required|string',
            'url' => 'nullable|string',
            'api_version' => 'nullable|string',
        ];
    }

    public function tools(): array
    {
        return [
            'tally_get_current_user' => $this->tool(TallyGetCurrentUser::class, 'read', 'Tally Get Current User', 'Get the authenticated Tally user profile.'),
            'tally_list_forms' => $this->tool(TallyListForms::class, 'read', 'Tally List Forms', 'List forms with pagination and workspace filtering.'),
            'tally_create_form' => $this->tool(TallyCreateForm::class, 'write', 'Tally Create Form', 'Create a form from blocks, settings, a template, or a workspace target.'),
            'tally_get_form' => $this->tool(TallyGetForm::class, 'read', 'Tally Get Form', 'Get a form by ID.'),
            'tally_update_form' => $this->tool(TallyUpdateForm::class, 'write', 'Tally Update Form', 'Update a form name, status, blocks, or settings.'),
            'tally_delete_form' => $this->tool(TallyDeleteForm::class, 'write', 'Tally Delete Form', 'Delete a form.'),
            'tally_list_questions' => $this->tool(TallyListQuestions::class, 'read', 'Tally List Questions', 'List questions for a form.'),
            'tally_update_question' => $this->tool(TallyUpdateQuestion::class, 'write', 'Tally Update Question', 'Update a question title.'),
            'tally_list_blocks' => $this->tool(TallyListBlocks::class, 'read', 'Tally List Blocks', 'List blocks for a form.'),
            'tally_update_blocks' => $this->tool(TallyUpdateBlocks::class, 'write', 'Tally Update Blocks', 'Replace a form block tree.'),
            'tally_list_submissions' => $this->tool(TallyListSubmissions::class, 'read', 'Tally List Submissions', 'List form submissions with status/date/cursor filters.'),
            'tally_get_submission' => $this->tool(TallyGetSubmission::class, 'read', 'Tally Get Submission', 'Get a form-scoped submission by ID.'),
            'tally_delete_submission' => $this->tool(TallyDeleteSubmission::class, 'write', 'Tally Delete Submission', 'Delete a form-scoped submission.'),
            'tally_list_workspaces' => $this->tool(TallyListWorkspaces::class, 'read', 'Tally List Workspaces', 'List workspaces.'),
            'tally_create_workspace' => $this->tool(TallyCreateWorkspace::class, 'write', 'Tally Create Workspace', 'Create a workspace.'),
            'tally_get_workspace' => $this->tool(TallyGetWorkspace::class, 'read', 'Tally Get Workspace', 'Get a workspace by ID.'),
            'tally_update_workspace' => $this->tool(TallyUpdateWorkspace::class, 'write', 'Tally Update Workspace', 'Rename a workspace.'),
            'tally_delete_workspace' => $this->tool(TallyDeleteWorkspace::class, 'write', 'Tally Delete Workspace', 'Delete a workspace.'),
            'tally_list_organization_users' => $this->tool(TallyListOrganizationUsers::class, 'read', 'Tally List Organization Users', 'List users in an organization.'),
            'tally_remove_organization_user' => $this->tool(TallyRemoveOrganizationUser::class, 'write', 'Tally Remove Organization User', 'Remove a user from an organization.'),
            'tally_list_organization_invites' => $this->tool(TallyListOrganizationInvites::class, 'read', 'Tally List Organization Invites', 'List organization invites.'),
            'tally_create_organization_invite' => $this->tool(TallyCreateOrganizationInvite::class, 'write', 'Tally Create Organization Invite', 'Invite users to organization workspaces.'),
            'tally_cancel_organization_invite' => $this->tool(TallyCancelOrganizationInvite::class, 'write', 'Tally Cancel Organization Invite', 'Cancel a pending organization invite.'),
            'tally_list_webhooks' => $this->tool(TallyListWebhooks::class, 'read', 'Tally List Webhooks', 'List registered webhooks.'),
            'tally_create_webhook' => $this->tool(TallyCreateWebhook::class, 'write', 'Tally Create Webhook', 'Create a webhook subscription.'),
            'tally_update_webhook' => $this->tool(TallyUpdateWebhook::class, 'write', 'Tally Update Webhook', 'Update a webhook subscription.'),
            'tally_delete_webhook' => $this->tool(TallyDeleteWebhook::class, 'write', 'Tally Delete Webhook', 'Delete a webhook subscription.'),
            'tally_list_webhook_events' => $this->tool(TallyListWebhookEvents::class, 'read', 'Tally List Webhook Events', 'List delivery events for a webhook.'),
            'tally_retry_webhook_event' => $this->tool(TallyRetryWebhookEvent::class, 'write', 'Tally Retry Webhook Event', 'Retry a webhook delivery event.'),
            'tally_api_get' => $this->tool(TallyApiGet::class, 'read', 'Tally API GET', 'Call a documented Tally GET endpoint not yet wrapped by a named tool.'),
            'tally_api_post' => $this->tool(TallyApiPost::class, 'write', 'Tally API POST', 'Call a documented Tally POST endpoint not yet wrapped by a named tool.'),
            'tally_api_patch' => $this->tool(TallyApiPatch::class, 'write', 'Tally API PATCH', 'Call a documented Tally PATCH endpoint not yet wrapped by a named tool.'),
            'tally_api_delete' => $this->tool(TallyApiDelete::class, 'write', 'Tally API DELETE', 'Call a documented Tally DELETE endpoint not yet wrapped by a named tool.'),
        ];
    }

    public function scriptDocsPath(): ?string
    {
        return dirname(__DIR__).'/script-docs/tally.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.tally.so'],
            ['key' => 'api_version', 'type' => 'text', 'label' => 'API Version', 'required' => false, 'default' => '2026-02-05'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance with optional multi-account credential resolution.
     *
     * @param  class-string<Tool>  $class  The tool class to instantiate.
     * @param  array<string, mixed>  $context  Runtime context, may include an account key.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the Tally API service for default or account-specific credentials.
     *
     * @param  array<string, mixed>  $context  Runtime context with optional account key.
     */
    private function resolveService(array $context = []): TallyService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new TallyService(
                accessToken: $creds->get('tally', 'access_token', '', $account),
                baseUrl: $creds->get('tally', 'url', 'https://api.tally.so', $account),
                apiVersion: $creds->get('tally', 'api_version', '2026-02-05', $account),
            );
        }

        return app(TallyService::class);
    }

    /**
     * Build catalog metadata for a tool class.
     *
     * @param  class-string<Tool>  $class  Tool class name.
     * @return array<string, mixed>
     */
    private function tool(string $class, string $type, string $name, string $description): array
    {
        return [
            'class' => $class,
            'type' => $type,
            'name' => $name,
            'description' => $description,
            'icon' => 'ph:wrench',
        ];
    }
}
