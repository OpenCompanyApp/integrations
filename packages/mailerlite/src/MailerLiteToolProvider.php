<?php

namespace OpenCompany\Integrations\MailerLite;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Provides MailerLite tools and integration metadata.
 *
 * Registers the current MailerLite API surface for discovery and resolves
 * account-scoped service instances for multi-account host applications.
 */
class MailerLiteToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'strategy' => 'api_key',
                'legacy_auth_type' => 'api_key',
                'credential_mode' => 'secret',
                'setup_flows' => ['manual_secret'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => [],
                'notes' => [],
            ],
            'host_availability' => [
                'web' => [
                    'setup_supported' => true,
                    'runtime_supported' => true,
                    'setup_mode' => 'manual_secret',
                ],
                'cli' => [
                    'setup_supported' => true,
                    'runtime_supported' => true,
                    'setup_mode' => 'manual_secret',
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
        return 'mailerlite';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'MailerLite',
            'description' => 'Email marketing and subscriber automation',
            'icon' => 'ph:envelope',
            'logo' => 'simple-icons:mailerlite',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'MailerLite',
            'description' => 'Email marketing, subscribers, campaigns, automations, forms, and webhooks',
            'icon' => 'ph:envelope',
            'logo' => 'simple-icons:mailerlite',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://developers.mailerlite.com/docs/',
        ];
    }

    /**
     * Get the configuration schema for the integration settings UI.
     *
     * @return array<int, array<string, mixed>>
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your MailerLite API key',
                'hint' => 'Generate an API key in MailerLite under Integrations > MailerLite API.',
                'required' => true,
            ],
        ];
    }

    /**
     * Test the connection with a lightweight subscriber-count request.
     *
     * @param  array<string, mixed>  $config  Integration configuration values.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->timeout(10)->get('https://connect.mailerlite.com/api/subscribers', [
                'limit' => 0,
            ]);

            if (!$response->successful()) {
                return [
                    'success' => false,
                    'error' => 'MailerLite API rejected the credentials.',
                ];
            }

            $total = $response->json('total');

            return [
                'success' => true,
                'message' => $total === null ? 'Connected to MailerLite.' : "Connected to MailerLite. Subscriber total: {$total}.",
            ];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Get validation rules for the integration configuration.
     *
     * @return array<string, string|array<int, string>>
     */
    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
        ];
    }

    /**
     * Get the list of tools provided by this integration.
     *
     * @return array<string, array<string, mixed>>
     */
    public function tools(): array
    {
        return [
            'mailerlite_list_subscribers' => ['class' => 'OpenCompany\\Integrations\\MailerLite\\Tools\\MailerLiteListSubscribers', 'type' => 'read', 'name' => 'List Subscribers', 'description' => 'List subscribers with cursor pagination, status filtering, and groups include.', 'icon' => 'ph:users'],
            'mailerlite_get_subscriber' => ['class' => 'OpenCompany\\Integrations\\MailerLite\\Tools\\MailerLiteGetSubscriber', 'type' => 'read', 'name' => 'Get Subscriber', 'description' => 'Get a subscriber by ID or email address.', 'icon' => 'ph:user'],
            'mailerlite_create_subscriber' => ['class' => 'OpenCompany\\Integrations\\MailerLite\\Tools\\MailerLiteCreateSubscriber', 'type' => 'write', 'name' => 'Create or Upsert Subscriber', 'description' => 'Create or upsert a subscriber with fields, groups, and status.', 'icon' => 'ph:user-plus'],
            'mailerlite_update_subscriber' => ['class' => 'OpenCompany\\Integrations\\MailerLite\\Tools\\MailerLiteUpdateSubscriber', 'type' => 'write', 'name' => 'Update Subscriber', 'description' => 'Update subscriber fields, groups, status, or subscription timestamp.', 'icon' => 'ph:pencil'],
            'mailerlite_delete_subscriber' => ['class' => 'OpenCompany\\Integrations\\MailerLite\\Tools\\MailerLiteDeleteSubscriber', 'type' => 'write', 'name' => 'Delete Subscriber', 'description' => 'Delete a subscriber by ID or email address.', 'icon' => 'ph:trash'],
            'mailerlite_list_subscriber_activity' => ['class' => 'OpenCompany\\Integrations\\MailerLite\\Tools\\MailerLiteListSubscriberActivity', 'type' => 'read', 'name' => 'List Subscriber Activity', 'description' => 'List subscriber activity log entries.', 'icon' => 'ph:activity'],
            'mailerlite_list_groups' => ['class' => 'OpenCompany\\Integrations\\MailerLite\\Tools\\MailerLiteListGroups', 'type' => 'read', 'name' => 'List Groups', 'description' => 'List subscriber groups.', 'icon' => 'ph:folders'],
            'mailerlite_create_group' => ['class' => 'OpenCompany\\Integrations\\MailerLite\\Tools\\MailerLiteCreateGroup', 'type' => 'write', 'name' => 'Create Group', 'description' => 'Create a subscriber group.', 'icon' => 'ph:folder-plus'],
            'mailerlite_update_group' => ['class' => 'OpenCompany\\Integrations\\MailerLite\\Tools\\MailerLiteUpdateGroup', 'type' => 'write', 'name' => 'Update Group', 'description' => 'Update a subscriber group.', 'icon' => 'ph:pencil'],
            'mailerlite_delete_group' => ['class' => 'OpenCompany\\Integrations\\MailerLite\\Tools\\MailerLiteDeleteGroup', 'type' => 'write', 'name' => 'Delete Group', 'description' => 'Delete a subscriber group.', 'icon' => 'ph:trash'],
            'mailerlite_list_group_subscribers' => ['class' => 'OpenCompany\\Integrations\\MailerLite\\Tools\\MailerLiteListGroupSubscribers', 'type' => 'read', 'name' => 'List Group Subscribers', 'description' => 'List subscribers belonging to a group.', 'icon' => 'ph:users-three'],
            'mailerlite_add_subscriber_to_group' => ['class' => 'OpenCompany\\Integrations\\MailerLite\\Tools\\MailerLiteAddSubscriberToGroup', 'type' => 'write', 'name' => 'Add Subscriber to Group', 'description' => 'Create or update a subscriber and include a group assignment.', 'icon' => 'ph:user-plus'],
            'mailerlite_assign_subscriber_to_group' => ['class' => 'OpenCompany\\Integrations\\MailerLite\\Tools\\MailerLiteAssignSubscriberToGroup', 'type' => 'write', 'name' => 'Assign Subscriber to Group', 'description' => 'Assign an existing subscriber to a group.', 'icon' => 'ph:user-plus'],
            'mailerlite_unassign_subscriber_from_group' => ['class' => 'OpenCompany\\Integrations\\MailerLite\\Tools\\MailerLiteUnassignSubscriberFromGroup', 'type' => 'write', 'name' => 'Unassign Subscriber from Group', 'description' => 'Remove an existing subscriber from a group.', 'icon' => 'ph:user-minus'],
            'mailerlite_import_subscribers_to_group' => ['class' => 'OpenCompany\\Integrations\\MailerLite\\Tools\\MailerLiteImportSubscribersToGroup', 'type' => 'write', 'name' => 'Import Subscribers to Group', 'description' => 'Bulk import subscribers into a group.', 'icon' => 'ph:upload'],
            'mailerlite_list_segments' => ['class' => 'OpenCompany\\Integrations\\MailerLite\\Tools\\MailerLiteListSegments', 'type' => 'read', 'name' => 'List Segments', 'description' => 'List audience segments.', 'icon' => 'ph:funnel'],
            'mailerlite_list_segment_subscribers' => ['class' => 'OpenCompany\\Integrations\\MailerLite\\Tools\\MailerLiteListSegmentSubscribers', 'type' => 'read', 'name' => 'List Segment Subscribers', 'description' => 'List subscribers belonging to a segment.', 'icon' => 'ph:users-three'],
            'mailerlite_update_segment' => ['class' => 'OpenCompany\\Integrations\\MailerLite\\Tools\\MailerLiteUpdateSegment', 'type' => 'write', 'name' => 'Update Segment', 'description' => 'Update a segment name.', 'icon' => 'ph:pencil'],
            'mailerlite_delete_segment' => ['class' => 'OpenCompany\\Integrations\\MailerLite\\Tools\\MailerLiteDeleteSegment', 'type' => 'write', 'name' => 'Delete Segment', 'description' => 'Delete a segment.', 'icon' => 'ph:trash'],
            'mailerlite_list_fields' => ['class' => 'OpenCompany\\Integrations\\MailerLite\\Tools\\MailerLiteListFields', 'type' => 'read', 'name' => 'List Fields', 'description' => 'List subscriber fields.', 'icon' => 'ph:list-dashes'],
            'mailerlite_create_field' => ['class' => 'OpenCompany\\Integrations\\MailerLite\\Tools\\MailerLiteCreateField', 'type' => 'write', 'name' => 'Create Field', 'description' => 'Create a subscriber field.', 'icon' => 'ph:textbox'],
            'mailerlite_update_field' => ['class' => 'OpenCompany\\Integrations\\MailerLite\\Tools\\MailerLiteUpdateField', 'type' => 'write', 'name' => 'Update Field', 'description' => 'Update a subscriber field.', 'icon' => 'ph:pencil'],
            'mailerlite_delete_field' => ['class' => 'OpenCompany\\Integrations\\MailerLite\\Tools\\MailerLiteDeleteField', 'type' => 'write', 'name' => 'Delete Field', 'description' => 'Delete a subscriber field.', 'icon' => 'ph:trash'],
            'mailerlite_list_automations' => ['class' => 'OpenCompany\\Integrations\\MailerLite\\Tools\\MailerLiteListAutomations', 'type' => 'read', 'name' => 'List Automations', 'description' => 'List automations and stats.', 'icon' => 'ph:flow-arrow'],
            'mailerlite_get_automation' => ['class' => 'OpenCompany\\Integrations\\MailerLite\\Tools\\MailerLiteGetAutomation', 'type' => 'read', 'name' => 'Get Automation', 'description' => 'Get an automation by ID.', 'icon' => 'ph:flow-arrow'],
            'mailerlite_list_automation_activity' => ['class' => 'OpenCompany\\Integrations\\MailerLite\\Tools\\MailerLiteListAutomationActivity', 'type' => 'read', 'name' => 'List Automation Activity', 'description' => 'List subscriber activity for an automation.', 'icon' => 'ph:activity'],
            'mailerlite_create_automation' => ['class' => 'OpenCompany\\Integrations\\MailerLite\\Tools\\MailerLiteCreateAutomation', 'type' => 'write', 'name' => 'Create Automation', 'description' => 'Create a draft automation.', 'icon' => 'ph:plus-circle'],
            'mailerlite_delete_automation' => ['class' => 'OpenCompany\\Integrations\\MailerLite\\Tools\\MailerLiteDeleteAutomation', 'type' => 'write', 'name' => 'Delete Automation', 'description' => 'Delete an automation.', 'icon' => 'ph:trash'],
            'mailerlite_list_campaigns' => ['class' => 'OpenCompany\\Integrations\\MailerLite\\Tools\\MailerLiteListCampaigns', 'type' => 'read', 'name' => 'List Campaigns', 'description' => 'List campaigns.', 'icon' => 'ph:megaphone'],
            'mailerlite_get_campaign' => ['class' => 'OpenCompany\\Integrations\\MailerLite\\Tools\\MailerLiteGetCampaign', 'type' => 'read', 'name' => 'Get Campaign', 'description' => 'Get a campaign by ID.', 'icon' => 'ph:megaphone'],
            'mailerlite_create_campaign' => ['class' => 'OpenCompany\\Integrations\\MailerLite\\Tools\\MailerLiteCreateCampaign', 'type' => 'write', 'name' => 'Create Campaign', 'description' => 'Create a campaign.', 'icon' => 'ph:plus-circle'],
            'mailerlite_update_campaign' => ['class' => 'OpenCompany\\Integrations\\MailerLite\\Tools\\MailerLiteUpdateCampaign', 'type' => 'write', 'name' => 'Update Campaign', 'description' => 'Update a campaign.', 'icon' => 'ph:pencil'],
            'mailerlite_schedule_campaign' => ['class' => 'OpenCompany\\Integrations\\MailerLite\\Tools\\MailerLiteScheduleCampaign', 'type' => 'write', 'name' => 'Schedule Campaign', 'description' => 'Schedule a campaign send.', 'icon' => 'ph:calendar-check'],
            'mailerlite_cancel_campaign' => ['class' => 'OpenCompany\\Integrations\\MailerLite\\Tools\\MailerLiteCancelCampaign', 'type' => 'write', 'name' => 'Cancel Campaign', 'description' => 'Cancel a campaign send.', 'icon' => 'ph:x-circle'],
            'mailerlite_delete_campaign' => ['class' => 'OpenCompany\\Integrations\\MailerLite\\Tools\\MailerLiteDeleteCampaign', 'type' => 'write', 'name' => 'Delete Campaign', 'description' => 'Delete a campaign.', 'icon' => 'ph:trash'],
            'mailerlite_list_campaign_subscriber_activity' => ['class' => 'OpenCompany\\Integrations\\MailerLite\\Tools\\MailerLiteListCampaignSubscriberActivity', 'type' => 'read', 'name' => 'List Campaign Subscriber Activity', 'description' => 'List subscriber activity for a sent campaign.', 'icon' => 'ph:activity'],
            'mailerlite_list_forms' => ['class' => 'OpenCompany\\Integrations\\MailerLite\\Tools\\MailerLiteListForms', 'type' => 'read', 'name' => 'List Forms', 'description' => 'List popup, embedded, or promotion forms.', 'icon' => 'ph:browser'],
            'mailerlite_get_form' => ['class' => 'OpenCompany\\Integrations\\MailerLite\\Tools\\MailerLiteGetForm', 'type' => 'read', 'name' => 'Get Form', 'description' => 'Get a form by ID.', 'icon' => 'ph:browser'],
            'mailerlite_update_form' => ['class' => 'OpenCompany\\Integrations\\MailerLite\\Tools\\MailerLiteUpdateForm', 'type' => 'write', 'name' => 'Update Form', 'description' => 'Update a form.', 'icon' => 'ph:pencil'],
            'mailerlite_delete_form' => ['class' => 'OpenCompany\\Integrations\\MailerLite\\Tools\\MailerLiteDeleteForm', 'type' => 'write', 'name' => 'Delete Form', 'description' => 'Delete a form.', 'icon' => 'ph:trash'],
            'mailerlite_list_form_subscribers' => ['class' => 'OpenCompany\\Integrations\\MailerLite\\Tools\\MailerLiteListFormSubscribers', 'type' => 'read', 'name' => 'List Form Subscribers', 'description' => 'List subscribers from a form.', 'icon' => 'ph:users'],
            'mailerlite_list_webhooks' => ['class' => 'OpenCompany\\Integrations\\MailerLite\\Tools\\MailerLiteListWebhooks', 'type' => 'read', 'name' => 'List Webhooks', 'description' => 'List webhooks.', 'icon' => 'ph:webhooks-logo'],
            'mailerlite_get_webhook' => ['class' => 'OpenCompany\\Integrations\\MailerLite\\Tools\\MailerLiteGetWebhook', 'type' => 'read', 'name' => 'Get Webhook', 'description' => 'Get a webhook by ID.', 'icon' => 'ph:webhooks-logo'],
            'mailerlite_create_webhook' => ['class' => 'OpenCompany\\Integrations\\MailerLite\\Tools\\MailerLiteCreateWebhook', 'type' => 'write', 'name' => 'Create Webhook', 'description' => 'Create a webhook.', 'icon' => 'ph:plus-circle'],
            'mailerlite_update_webhook' => ['class' => 'OpenCompany\\Integrations\\MailerLite\\Tools\\MailerLiteUpdateWebhook', 'type' => 'write', 'name' => 'Update Webhook', 'description' => 'Update a webhook.', 'icon' => 'ph:pencil'],
            'mailerlite_delete_webhook' => ['class' => 'OpenCompany\\Integrations\\MailerLite\\Tools\\MailerLiteDeleteWebhook', 'type' => 'write', 'name' => 'Delete Webhook', 'description' => 'Delete a webhook.', 'icon' => 'ph:trash'],
            'mailerlite_batch' => ['class' => 'OpenCompany\\Integrations\\MailerLite\\Tools\\MailerLiteBatch', 'type' => 'write', 'name' => 'Batch Requests', 'description' => 'Execute a MailerLite batch request.', 'icon' => 'ph:stack'],
            'mailerlite_get_current_user' => ['class' => 'OpenCompany\\Integrations\\MailerLite\\Tools\\MailerLiteGetCurrentUser', 'type' => 'read', 'name' => 'Verify Credentials', 'description' => 'Verify credentials with a lightweight subscriber summary call.', 'icon' => 'ph:identification-badge'],
            'mailerlite_api_get' => ['class' => 'OpenCompany\\Integrations\\MailerLite\\Tools\\MailerLiteApiGet', 'type' => 'read', 'name' => 'API GET', 'description' => 'Call a safe relative MailerLite API path with GET.', 'icon' => 'ph:code'],
            'mailerlite_api_post' => ['class' => 'OpenCompany\\Integrations\\MailerLite\\Tools\\MailerLiteApiPost', 'type' => 'write', 'name' => 'API POST', 'description' => 'Call a safe relative MailerLite API path with POST.', 'icon' => 'ph:code'],
            'mailerlite_api_put' => ['class' => 'OpenCompany\\Integrations\\MailerLite\\Tools\\MailerLiteApiPut', 'type' => 'write', 'name' => 'API PUT', 'description' => 'Call a safe relative MailerLite API path with PUT.', 'icon' => 'ph:code'],
            'mailerlite_api_patch' => ['class' => 'OpenCompany\\Integrations\\MailerLite\\Tools\\MailerLiteApiPatch', 'type' => 'write', 'name' => 'API PATCH', 'description' => 'Call a safe relative MailerLite API path with PATCH.', 'icon' => 'ph:code'],
            'mailerlite_api_delete' => ['class' => 'OpenCompany\\Integrations\\MailerLite\\Tools\\MailerLiteApiDelete', 'type' => 'write', 'name' => 'API DELETE', 'description' => 'Call a safe relative MailerLite API path with DELETE.', 'icon' => 'ph:code'],
        ];
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__ . '/../script-docs/mailerlite.md';
    }

    /**
     * Get the credential fields required for this integration.
     *
     * @return array<int, array<string, mixed>>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance, optionally resolved for a specific account.
     *
     * @param  string  $class  Fully-qualified tool class name.
     * @param  array<string, mixed>  $context  Context with optional account key.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve a service instance for default or account-scoped credentials.
     *
     * @param  array<string, mixed>  $context  Tool creation context.
     */
    private function resolveService(array $context = []): MailerLiteService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new MailerLiteService(
                apiKey: $creds->get('mailerlite', 'api_key', '', $account),
            );
        }

        return app(MailerLiteService::class);
    }

}
