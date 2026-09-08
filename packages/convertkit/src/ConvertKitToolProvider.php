<?php

namespace OpenCompany\Integrations\ConvertKit;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Provides Kit API tools and integration metadata.
 *
 * Exposes the current Kit V4 surface for agent discovery and resolves
 * account-scoped services for multi-account host applications.
 */
class ConvertKitToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'notes' => [
                    'OAuth access tokens can be supplied for endpoints Kit restricts to OAuth, such as bulk and purchase creation.',
                ],
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
        return 'convertkit';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Kit',
            'description' => 'Creator email marketing and subscriber automation',
            'icon' => 'ph:envelope',
            'logo' => 'simple-icons:convertkit',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Kit',
            'description' => 'Creator email marketing, subscribers, tags, forms, broadcasts, sequences, commerce, and webhooks',
            'icon' => 'ph:envelope',
            'logo' => 'simple-icons:convertkit',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://developers.kit.com/api-reference/overview',
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
                'label' => 'V4 API Key',
                'placeholder' => 'Enter your Kit V4 API key',
                'hint' => 'Create a V4 API key from Kit account settings under Developer.',
                'required' => false,
            ],
            [
                'key' => 'oauth_access_token',
                'type' => 'secret',
                'label' => 'OAuth Access Token',
                'placeholder' => 'Optional OAuth access token',
                'hint' => 'Use for endpoints Kit restricts to OAuth, including bulk and purchase creation.',
                'required' => false,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.kit.com',
                'hint' => 'Defaults to https://api.kit.com. Change only for a compatible proxy.',
                'default' => 'https://api.kit.com',
                'required' => false,
            ],
        ];
    }

    /**
     * Test the connection against the current account endpoint.
     *
     * @param  array<string, mixed>  $config  Integration configuration values.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = (string) ($config['api_key'] ?? '');
        $accessToken = (string) ($config['oauth_access_token'] ?? '');
        $baseUrl = rtrim((string) ($config['url'] ?? 'https://api.kit.com'), '/');

        if ($apiKey === '' && $accessToken === '') {
            return ['success' => false, 'error' => 'Provide a Kit V4 API key or OAuth access token.'];
        }

        try {
            $headers = [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ];

            if ($accessToken !== '') {
                $headers['Authorization'] = 'Bearer ' . $accessToken;
            } else {
                $headers['X-Kit-Api-Key'] = $apiKey;
            }

            $response = Http::withHeaders($headers)->timeout(10)->get($baseUrl . '/v4/account');

            if (!$response->successful()) {
                $errors = $response->json('errors');
                $error = is_array($errors) ? implode('; ', $errors) : ($response->json('error') ?? $response->json('message') ?? "HTTP {$response->status()}");

                return [
                    'success' => false,
                    'error' => 'Kit API rejected the credentials: ' . (is_string($error) ? $error : json_encode($error)),
                ];
            }

            $name = $response->json('account.name') ?? 'Kit';

            return [
                'success' => true,
                'message' => "Connected to {$name}.",
            ];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Get validation rules for integration configuration.
     *
     * @return array<string, string>
     */
    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
            'oauth_access_token' => 'nullable|string',
            'url' => 'nullable|url',
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
            'convertkit_get_current_account' => ['class' => 'OpenCompany\\Integrations\\ConvertKit\\Tools\\ConvertKitGetCurrentAccount', 'type' => 'read', 'name' => 'Get Current Account', 'description' => 'Get the authenticated Kit user and account.', 'icon' => 'ph:identification-badge'],
            'convertkit_get_current_user' => ['class' => 'OpenCompany\\Integrations\\ConvertKit\\Tools\\ConvertKitGetCurrentUser', 'type' => 'read', 'name' => 'Get Current User', 'description' => 'Legacy alias for getting the authenticated Kit account.', 'icon' => 'ph:identification-badge'],
            'convertkit_get_creator_profile' => ['class' => 'OpenCompany\\Integrations\\ConvertKit\\Tools\\ConvertKitGetCreatorProfile', 'type' => 'read', 'name' => 'Get Creator Profile', 'description' => 'Get Creator Profile details for the account.', 'icon' => 'ph:user-circle'],
            'convertkit_get_email_stats' => ['class' => 'OpenCompany\\Integrations\\ConvertKit\\Tools\\ConvertKitGetEmailStats', 'type' => 'read', 'name' => 'Get Email Stats', 'description' => 'Get account email stats for the recent reporting window.', 'icon' => 'ph:chart-line'],
            'convertkit_get_growth_stats' => ['class' => 'OpenCompany\\Integrations\\ConvertKit\\Tools\\ConvertKitGetGrowthStats', 'type' => 'read', 'name' => 'Get Growth Stats', 'description' => 'Get account subscriber growth stats for a date range.', 'icon' => 'ph:trend-up'],
            'convertkit_list_colors' => ['class' => 'OpenCompany\\Integrations\\ConvertKit\\Tools\\ConvertKitListColors', 'type' => 'read', 'name' => 'List Colors', 'description' => 'List brand colors configured for the account.', 'icon' => 'ph:palette'],
            'convertkit_update_colors' => ['class' => 'OpenCompany\\Integrations\\ConvertKit\\Tools\\ConvertKitUpdateColors', 'type' => 'write', 'name' => 'Update Colors', 'description' => 'Update account brand colors.', 'icon' => 'ph:palette'],
            'convertkit_list_broadcasts' => ['class' => 'OpenCompany\\Integrations\\ConvertKit\\Tools\\ConvertKitListBroadcasts', 'type' => 'read', 'name' => 'List Broadcasts', 'description' => 'List broadcasts with cursor pagination.', 'icon' => 'ph:megaphone'],
            'convertkit_create_broadcast' => ['class' => 'OpenCompany\\Integrations\\ConvertKit\\Tools\\ConvertKitCreateBroadcast', 'type' => 'write', 'name' => 'Create Broadcast', 'description' => 'Create a draft, public post, or scheduled broadcast.', 'icon' => 'ph:plus-circle'],
            'convertkit_get_broadcast' => ['class' => 'OpenCompany\\Integrations\\ConvertKit\\Tools\\ConvertKitGetBroadcast', 'type' => 'read', 'name' => 'Get Broadcast', 'description' => 'Get a broadcast by ID.', 'icon' => 'ph:megaphone'],
            'convertkit_update_broadcast' => ['class' => 'OpenCompany\\Integrations\\ConvertKit\\Tools\\ConvertKitUpdateBroadcast', 'type' => 'write', 'name' => 'Update Broadcast', 'description' => 'Update a broadcast draft or schedule.', 'icon' => 'ph:pencil'],
            'convertkit_delete_broadcast' => ['class' => 'OpenCompany\\Integrations\\ConvertKit\\Tools\\ConvertKitDeleteBroadcast', 'type' => 'write', 'name' => 'Delete Broadcast', 'description' => 'Delete a broadcast.', 'icon' => 'ph:trash'],
            'convertkit_get_broadcast_stats' => ['class' => 'OpenCompany\\Integrations\\ConvertKit\\Tools\\ConvertKitGetBroadcastStats', 'type' => 'read', 'name' => 'Get Broadcast Stats', 'description' => 'Get stats for a single broadcast.', 'icon' => 'ph:chart-bar'],
            'convertkit_list_broadcast_stats' => ['class' => 'OpenCompany\\Integrations\\ConvertKit\\Tools\\ConvertKitListBroadcastStats', 'type' => 'read', 'name' => 'List Broadcast Stats', 'description' => 'List stats for broadcasts.', 'icon' => 'ph:chart-bar'],
            'convertkit_get_broadcast_clicks' => ['class' => 'OpenCompany\\Integrations\\ConvertKit\\Tools\\ConvertKitGetBroadcastClicks', 'type' => 'read', 'name' => 'Get Broadcast Clicks', 'description' => 'Get link click details for a broadcast.', 'icon' => 'ph:cursor-click'],
            'convertkit_list_custom_fields' => ['class' => 'OpenCompany\\Integrations\\ConvertKit\\Tools\\ConvertKitListCustomFields', 'type' => 'read', 'name' => 'List Custom Fields', 'description' => 'List subscriber custom fields.', 'icon' => 'ph:list-dashes'],
            'convertkit_create_custom_field' => ['class' => 'OpenCompany\\Integrations\\ConvertKit\\Tools\\ConvertKitCreateCustomField', 'type' => 'write', 'name' => 'Create Custom Field', 'description' => 'Create a custom field.', 'icon' => 'ph:textbox'],
            'convertkit_update_custom_field' => ['class' => 'OpenCompany\\Integrations\\ConvertKit\\Tools\\ConvertKitUpdateCustomField', 'type' => 'write', 'name' => 'Update Custom Field', 'description' => 'Update a custom field label.', 'icon' => 'ph:pencil'],
            'convertkit_delete_custom_field' => ['class' => 'OpenCompany\\Integrations\\ConvertKit\\Tools\\ConvertKitDeleteCustomField', 'type' => 'write', 'name' => 'Delete Custom Field', 'description' => 'Delete a custom field and its values.', 'icon' => 'ph:trash'],
            'convertkit_bulk_create_custom_fields' => ['class' => 'OpenCompany\\Integrations\\ConvertKit\\Tools\\ConvertKitBulkCreateCustomFields', 'type' => 'write', 'name' => 'Bulk Create Custom Fields', 'description' => 'Create custom fields in bulk. OAuth may be required by Kit.', 'icon' => 'ph:stack-plus'],
            'convertkit_bulk_update_subscriber_custom_fields' => ['class' => 'OpenCompany\\Integrations\\ConvertKit\\Tools\\ConvertKitBulkUpdateSubscriberCustomFields', 'type' => 'write', 'name' => 'Bulk Update Subscriber Custom Fields', 'description' => 'Bulk update subscriber custom field values. OAuth may be required by Kit.', 'icon' => 'ph:stack'],
            'convertkit_list_email_templates' => ['class' => 'OpenCompany\\Integrations\\ConvertKit\\Tools\\ConvertKitListEmailTemplates', 'type' => 'read', 'name' => 'List Email Templates', 'description' => 'List email templates available for broadcasts.', 'icon' => 'ph:layout'],
            'convertkit_list_forms' => ['class' => 'OpenCompany\\Integrations\\ConvertKit\\Tools\\ConvertKitListForms', 'type' => 'read', 'name' => 'List Forms', 'description' => 'List forms and landing pages.', 'icon' => 'ph:browser'],
            'convertkit_list_form_subscribers' => ['class' => 'OpenCompany\\Integrations\\ConvertKit\\Tools\\ConvertKitListFormSubscribers', 'type' => 'read', 'name' => 'List Form Subscribers', 'description' => 'List subscribers for a form.', 'icon' => 'ph:users'],
            'convertkit_add_subscriber_to_form' => ['class' => 'OpenCompany\\Integrations\\ConvertKit\\Tools\\ConvertKitAddSubscriberToForm', 'type' => 'write', 'name' => 'Add Subscriber to Form', 'description' => 'Add an existing subscriber to a form by subscriber ID.', 'icon' => 'ph:user-plus'],
            'convertkit_add_subscriber_to_form_by_email' => ['class' => 'OpenCompany\\Integrations\\ConvertKit\\Tools\\ConvertKitAddSubscriberToFormByEmail', 'type' => 'write', 'name' => 'Add Subscriber to Form by Email', 'description' => 'Add an existing subscriber to a form by email address.', 'icon' => 'ph:user-plus'],
            'convertkit_bulk_add_subscribers_to_forms' => ['class' => 'OpenCompany\\Integrations\\ConvertKit\\Tools\\ConvertKitBulkAddSubscribersToForms', 'type' => 'write', 'name' => 'Bulk Add Subscribers to Forms', 'description' => 'Bulk add subscribers to forms. OAuth may be required by Kit.', 'icon' => 'ph:stack-plus'],
            'convertkit_list_posts' => ['class' => 'OpenCompany\\Integrations\\ConvertKit\\Tools\\ConvertKitListPosts', 'type' => 'read', 'name' => 'List Posts', 'description' => 'List public posts from the account.', 'icon' => 'ph:newspaper'],
            'convertkit_get_post' => ['class' => 'OpenCompany\\Integrations\\ConvertKit\\Tools\\ConvertKitGetPost', 'type' => 'read', 'name' => 'Get Post', 'description' => 'Get a post by ID.', 'icon' => 'ph:newspaper'],
            'convertkit_list_purchases' => ['class' => 'OpenCompany\\Integrations\\ConvertKit\\Tools\\ConvertKitListPurchases', 'type' => 'read', 'name' => 'List Purchases', 'description' => 'List purchase records.', 'icon' => 'ph:shopping-cart'],
            'convertkit_create_purchase' => ['class' => 'OpenCompany\\Integrations\\ConvertKit\\Tools\\ConvertKitCreatePurchase', 'type' => 'write', 'name' => 'Create Purchase', 'description' => 'Create a purchase record. Kit documents this as OAuth-only.', 'icon' => 'ph:shopping-cart-simple'],
            'convertkit_get_purchase' => ['class' => 'OpenCompany\\Integrations\\ConvertKit\\Tools\\ConvertKitGetPurchase', 'type' => 'read', 'name' => 'Get Purchase', 'description' => 'Get a purchase by ID.', 'icon' => 'ph:receipt'],
            'convertkit_list_segments' => ['class' => 'OpenCompany\\Integrations\\ConvertKit\\Tools\\ConvertKitListSegments', 'type' => 'read', 'name' => 'List Segments', 'description' => 'List audience segments.', 'icon' => 'ph:funnel'],
            'convertkit_list_sequences' => ['class' => 'OpenCompany\\Integrations\\ConvertKit\\Tools\\ConvertKitListSequences', 'type' => 'read', 'name' => 'List Sequences', 'description' => 'List email sequences.', 'icon' => 'ph:flow-arrow'],
            'convertkit_create_sequence' => ['class' => 'OpenCompany\\Integrations\\ConvertKit\\Tools\\ConvertKitCreateSequence', 'type' => 'write', 'name' => 'Create Sequence', 'description' => 'Create a sequence.', 'icon' => 'ph:plus-circle'],
            'convertkit_get_sequence' => ['class' => 'OpenCompany\\Integrations\\ConvertKit\\Tools\\ConvertKitGetSequence', 'type' => 'read', 'name' => 'Get Sequence', 'description' => 'Get a sequence by ID.', 'icon' => 'ph:flow-arrow'],
            'convertkit_update_sequence' => ['class' => 'OpenCompany\\Integrations\\ConvertKit\\Tools\\ConvertKitUpdateSequence', 'type' => 'write', 'name' => 'Update Sequence', 'description' => 'Update a sequence.', 'icon' => 'ph:pencil'],
            'convertkit_delete_sequence' => ['class' => 'OpenCompany\\Integrations\\ConvertKit\\Tools\\ConvertKitDeleteSequence', 'type' => 'write', 'name' => 'Delete Sequence', 'description' => 'Delete a sequence.', 'icon' => 'ph:trash'],
            'convertkit_list_sequence_subscribers' => ['class' => 'OpenCompany\\Integrations\\ConvertKit\\Tools\\ConvertKitListSequenceSubscribers', 'type' => 'read', 'name' => 'List Sequence Subscribers', 'description' => 'List subscribers for a sequence.', 'icon' => 'ph:users-three'],
            'convertkit_add_subscriber_to_sequence' => ['class' => 'OpenCompany\\Integrations\\ConvertKit\\Tools\\ConvertKitAddSubscriberToSequence', 'type' => 'write', 'name' => 'Add Subscriber to Sequence', 'description' => 'Add an existing subscriber to a sequence by subscriber ID.', 'icon' => 'ph:user-plus'],
            'convertkit_add_subscriber_to_sequence_by_email' => ['class' => 'OpenCompany\\Integrations\\ConvertKit\\Tools\\ConvertKitAddSubscriberToSequenceByEmail', 'type' => 'write', 'name' => 'Add Subscriber to Sequence by Email', 'description' => 'Add an existing subscriber to a sequence by email address.', 'icon' => 'ph:user-plus'],
            'convertkit_list_snippets' => ['class' => 'OpenCompany\\Integrations\\ConvertKit\\Tools\\ConvertKitListSnippets', 'type' => 'read', 'name' => 'List Snippets', 'description' => 'List reusable snippets.', 'icon' => 'ph:brackets-curly'],
            'convertkit_create_snippet' => ['class' => 'OpenCompany\\Integrations\\ConvertKit\\Tools\\ConvertKitCreateSnippet', 'type' => 'write', 'name' => 'Create Snippet', 'description' => 'Create a snippet.', 'icon' => 'ph:plus-circle'],
            'convertkit_get_snippet' => ['class' => 'OpenCompany\\Integrations\\ConvertKit\\Tools\\ConvertKitGetSnippet', 'type' => 'read', 'name' => 'Get Snippet', 'description' => 'Get a snippet by ID.', 'icon' => 'ph:brackets-curly'],
            'convertkit_update_snippet' => ['class' => 'OpenCompany\\Integrations\\ConvertKit\\Tools\\ConvertKitUpdateSnippet', 'type' => 'write', 'name' => 'Update Snippet', 'description' => 'Update a snippet.', 'icon' => 'ph:pencil'],
            'convertkit_list_subscribers' => ['class' => 'OpenCompany\\Integrations\\ConvertKit\\Tools\\ConvertKitListSubscribers', 'type' => 'read', 'name' => 'List Subscribers', 'description' => 'List subscribers with cursor pagination and filters.', 'icon' => 'ph:users'],
            'convertkit_create_subscriber' => ['class' => 'OpenCompany\\Integrations\\ConvertKit\\Tools\\ConvertKitCreateSubscriber', 'type' => 'write', 'name' => 'Create Subscriber', 'description' => 'Create or upsert a subscriber.', 'icon' => 'ph:user-plus'],
            'convertkit_filter_subscribers' => ['class' => 'OpenCompany\\Integrations\\ConvertKit\\Tools\\ConvertKitFilterSubscribers', 'type' => 'read', 'name' => 'Filter Subscribers', 'description' => 'Filter subscribers based on engagement.', 'icon' => 'ph:funnel'],
            'convertkit_get_subscriber' => ['class' => 'OpenCompany\\Integrations\\ConvertKit\\Tools\\ConvertKitGetSubscriber', 'type' => 'read', 'name' => 'Get Subscriber', 'description' => 'Get a subscriber by ID.', 'icon' => 'ph:user'],
            'convertkit_update_subscriber' => ['class' => 'OpenCompany\\Integrations\\ConvertKit\\Tools\\ConvertKitUpdateSubscriber', 'type' => 'write', 'name' => 'Update Subscriber', 'description' => 'Update subscriber profile and custom fields.', 'icon' => 'ph:pencil'],
            'convertkit_unsubscribe_subscriber' => ['class' => 'OpenCompany\\Integrations\\ConvertKit\\Tools\\ConvertKitUnsubscribeSubscriber', 'type' => 'write', 'name' => 'Unsubscribe Subscriber', 'description' => 'Unsubscribe a subscriber by ID.', 'icon' => 'ph:user-minus'],
            'convertkit_list_subscriber_stats' => ['class' => 'OpenCompany\\Integrations\\ConvertKit\\Tools\\ConvertKitListSubscriberStats', 'type' => 'read', 'name' => 'List Subscriber Stats', 'description' => 'List email stats for a subscriber.', 'icon' => 'ph:chart-line'],
            'convertkit_list_subscriber_tags' => ['class' => 'OpenCompany\\Integrations\\ConvertKit\\Tools\\ConvertKitListSubscriberTags', 'type' => 'read', 'name' => 'List Subscriber Tags', 'description' => 'List tags applied to a subscriber.', 'icon' => 'ph:tags'],
            'convertkit_bulk_create_subscribers' => ['class' => 'OpenCompany\\Integrations\\ConvertKit\\Tools\\ConvertKitBulkCreateSubscribers', 'type' => 'write', 'name' => 'Bulk Create Subscribers', 'description' => 'Create subscribers in bulk. OAuth may be required by Kit.', 'icon' => 'ph:stack-plus'],
            'convertkit_list_tags' => ['class' => 'OpenCompany\\Integrations\\ConvertKit\\Tools\\ConvertKitListTags', 'type' => 'read', 'name' => 'List Tags', 'description' => 'List subscriber tags.', 'icon' => 'ph:tag'],
            'convertkit_create_tag' => ['class' => 'OpenCompany\\Integrations\\ConvertKit\\Tools\\ConvertKitCreateTag', 'type' => 'write', 'name' => 'Create Tag', 'description' => 'Create a tag.', 'icon' => 'ph:tag'],
            'convertkit_update_tag' => ['class' => 'OpenCompany\\Integrations\\ConvertKit\\Tools\\ConvertKitUpdateTag', 'type' => 'write', 'name' => 'Update Tag', 'description' => 'Update a tag name.', 'icon' => 'ph:pencil'],
            'convertkit_list_tag_subscribers' => ['class' => 'OpenCompany\\Integrations\\ConvertKit\\Tools\\ConvertKitListTagSubscribers', 'type' => 'read', 'name' => 'List Tag Subscribers', 'description' => 'List subscribers with a tag.', 'icon' => 'ph:users-three'],
            'convertkit_tag_subscriber' => ['class' => 'OpenCompany\\Integrations\\ConvertKit\\Tools\\ConvertKitTagSubscriber', 'type' => 'write', 'name' => 'Tag Subscriber', 'description' => 'Tag an existing subscriber by subscriber ID.', 'icon' => 'ph:user-plus'],
            'convertkit_tag_subscriber_by_email' => ['class' => 'OpenCompany\\Integrations\\ConvertKit\\Tools\\ConvertKitTagSubscriberByEmail', 'type' => 'write', 'name' => 'Tag Subscriber by Email', 'description' => 'Tag an existing subscriber by email address.', 'icon' => 'ph:user-plus'],
            'convertkit_remove_tag_from_subscriber' => ['class' => 'OpenCompany\\Integrations\\ConvertKit\\Tools\\ConvertKitRemoveTagFromSubscriber', 'type' => 'write', 'name' => 'Remove Tag from Subscriber', 'description' => 'Remove a tag from a subscriber by ID.', 'icon' => 'ph:user-minus'],
            'convertkit_remove_tag_from_subscriber_by_email' => ['class' => 'OpenCompany\\Integrations\\ConvertKit\\Tools\\ConvertKitRemoveTagFromSubscriberByEmail', 'type' => 'write', 'name' => 'Remove Tag from Subscriber by Email', 'description' => 'Remove a tag from a subscriber by email address.', 'icon' => 'ph:user-minus'],
            'convertkit_bulk_create_tags' => ['class' => 'OpenCompany\\Integrations\\ConvertKit\\Tools\\ConvertKitBulkCreateTags', 'type' => 'write', 'name' => 'Bulk Create Tags', 'description' => 'Create tags in bulk. OAuth may be required by Kit.', 'icon' => 'ph:stack-plus'],
            'convertkit_bulk_tag_subscribers' => ['class' => 'OpenCompany\\Integrations\\ConvertKit\\Tools\\ConvertKitBulkTagSubscribers', 'type' => 'write', 'name' => 'Bulk Tag Subscribers', 'description' => 'Apply tags to subscribers in bulk. OAuth may be required by Kit.', 'icon' => 'ph:stack-plus'],
            'convertkit_bulk_remove_tags_from_subscribers' => ['class' => 'OpenCompany\\Integrations\\ConvertKit\\Tools\\ConvertKitBulkRemoveTagsFromSubscribers', 'type' => 'write', 'name' => 'Bulk Remove Tags from Subscribers', 'description' => 'Remove tags from subscribers in bulk. OAuth may be required by Kit.', 'icon' => 'ph:stack'],
            'convertkit_list_webhooks' => ['class' => 'OpenCompany\\Integrations\\ConvertKit\\Tools\\ConvertKitListWebhooks', 'type' => 'read', 'name' => 'List Webhooks', 'description' => 'List subscriber event webhooks.', 'icon' => 'ph:webhooks-logo'],
            'convertkit_create_webhook' => ['class' => 'OpenCompany\\Integrations\\ConvertKit\\Tools\\ConvertKitCreateWebhook', 'type' => 'write', 'name' => 'Create Webhook', 'description' => 'Create a subscriber event webhook.', 'icon' => 'ph:plus-circle'],
            'convertkit_delete_webhook' => ['class' => 'OpenCompany\\Integrations\\ConvertKit\\Tools\\ConvertKitDeleteWebhook', 'type' => 'write', 'name' => 'Delete Webhook', 'description' => 'Delete a webhook.', 'icon' => 'ph:trash'],
            'convertkit_api_get' => ['class' => 'OpenCompany\\Integrations\\ConvertKit\\Tools\\ConvertKitApiGet', 'type' => 'read', 'name' => 'API GET', 'description' => 'Call a safe relative Kit API path with GET.', 'icon' => 'ph:code'],
            'convertkit_api_post' => ['class' => 'OpenCompany\\Integrations\\ConvertKit\\Tools\\ConvertKitApiPost', 'type' => 'write', 'name' => 'API POST', 'description' => 'Call a safe relative Kit API path with POST.', 'icon' => 'ph:code'],
            'convertkit_api_put' => ['class' => 'OpenCompany\\Integrations\\ConvertKit\\Tools\\ConvertKitApiPut', 'type' => 'write', 'name' => 'API PUT', 'description' => 'Call a safe relative Kit API path with PUT.', 'icon' => 'ph:code'],
            'convertkit_api_delete' => ['class' => 'OpenCompany\\Integrations\\ConvertKit\\Tools\\ConvertKitApiDelete', 'type' => 'write', 'name' => 'API DELETE', 'description' => 'Call a safe relative Kit API path with DELETE.', 'icon' => 'ph:code'],
        ];
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__ . '/../script-docs/convertkit.md';
    }

    /**
     * Get credential fields needed for authentication.
     *
     * @return array<int, array<string, mixed>>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'V4 API Key', 'required' => false],
            ['key' => 'oauth_access_token', 'type' => 'secret', 'label' => 'OAuth Access Token', 'required' => false],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.kit.com'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance, optionally using account-scoped credentials.
     *
     * @param  string  $class  Fully-qualified tool class name.
     * @param  array<string, mixed>  $context  Context with optional account key.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the default or account-scoped Kit API service.
     *
     * @param  array<string, mixed>  $context  Tool creation context.
     */
    private function resolveService(array $context = []): ConvertKitService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new ConvertKitService(
                apiKey: $creds->get('convertkit', 'api_key', '', $account),
                baseUrl: $creds->get('convertkit', 'url', 'https://api.kit.com', $account),
                accessToken: $creds->get('convertkit', 'oauth_access_token', '', $account),
            );
        }

        return app(ConvertKitService::class);
    }
}
