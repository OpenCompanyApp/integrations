<?php

namespace OpenCompany\Integrations\Mailchimp;

use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Mailchimp\Tools\MailchimpAddSubscriber;
use OpenCompany\Integrations\Mailchimp\Tools\MailchimpAddToSegment;
use OpenCompany\Integrations\Mailchimp\Tools\MailchimpCreateAudience;
use OpenCompany\Integrations\Mailchimp\Tools\MailchimpCreateCampaign;
use OpenCompany\Integrations\Mailchimp\Tools\MailchimpGetAudience;
use OpenCompany\Integrations\Mailchimp\Tools\MailchimpGetCampaign;
use OpenCompany\Integrations\Mailchimp\Tools\MailchimpGetCampaignReport;
use OpenCompany\Integrations\Mailchimp\Tools\MailchimpGetCurrentUser;
use OpenCompany\Integrations\Mailchimp\Tools\MailchimpGetSubscriber;
use OpenCompany\Integrations\Mailchimp\Tools\MailchimpListAudiences;
use OpenCompany\Integrations\Mailchimp\Tools\MailchimpListCampaigns;
use OpenCompany\Integrations\Mailchimp\Tools\MailchimpListSegments;
use OpenCompany\Integrations\Mailchimp\Tools\MailchimpRemoveSubscriber;
use OpenCompany\Integrations\Mailchimp\Tools\MailchimpSearchSubscribers;
use OpenCompany\Integrations\Mailchimp\Tools\MailchimpSendCampaign;
use OpenCompany\Integrations\Mailchimp\Tools\MailchimpTagSubscriber;
use OpenCompany\Integrations\Mailchimp\Tools\MailchimpUpdateCampaign;
use OpenCompany\Integrations\Mailchimp\Tools\MailchimpUpdateSubscriber;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
/**
 * Registers all Mailchimp tools and provides integration metadata, configuration schema, and connection testing.
 */
class MailchimpToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities {

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
            'setup_flows' =>
            [
              0 => 'manual_secret',
            ],
            'requires_browser_for_setup' => false,
            'refreshable' => false,
            'token_keys' =>
            [
            ],
            'notes' =>
            [
            ],
          ],
          'host_availability' => [
            'web' =>
            [
              'setup_supported' => true,
              'runtime_supported' => true,
              'setup_mode' => 'manual_secret',
            ],
            'cli' =>
            [
              'setup_supported' => true,
              'runtime_supported' => true,
              'setup_mode' => 'manual_secret',
              'runtime_mode' => 'normal',
            ],
          ],
          'runtime_requirements' => [
          ],
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
        return 'mailchimp';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Mailchimp',
            'description' => 'Email marketing platform — manage audiences, subscribers, campaigns, and reports.',
            'icon' => 'ph:envelope-simple',
            'logo' => 'simple-icons:mailchimp',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Mailchimp',
            'description' => 'Connect Mailchimp to manage audiences, subscribers, campaigns, segments, and reports.',
            'icon' => 'ph:envelope-simple',
            'logo' => 'simple-icons:mailchimp',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://mailchimp.com/developer/marketing/api/',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'name' => 'api_key',
                'label' => 'API Key',
                'type' => 'text',
                'required' => true,
                'description' => 'Your Mailchimp API key (format: {key}-{datacenter}).',
                'placeholder' => 'a1b2c3d4e5f6g7h8i9j0-us6',
            ],
        ];
    }

    /** @param array<string, mixed> $config */
    public function testConnection(array $config): array
    {
        try {
            $apiKey = $config['api_key'] ?? '';
            $service = new MailchimpService(apiKey: $apiKey);

            if (! $service->isConfigured()) {
                return [
                    'success' => false,
                    'error' => 'Mailchimp API key is not configured.',
                ];
            }

            $result = $service->getCurrentUser();

            return [
                'success' => true,
                'message' => sprintf(
                    'Connected to Mailchimp account "%s" with %d total subscribers.',
                    $result['account_name'] ?? 'Unknown',
                    $result['total_subscribers'] ?? 0,
                ),
            ];
        } catch (\Throwable $e) {
            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }

    public function validationRules(): array
    {
        return ['api_key' => 'nullable|string'];
    }

    public function tools(): array
    {
        return [
            'mailchimp_list_audiences' => [
                'class' => MailchimpListAudiences::class,
                'type' => 'read',
                'name' => 'List Audiences',
                'description' => 'List all Mailchimp audiences.',
                'icon' => 'ph:users',
            ],
            'mailchimp_get_audience' => [
                'class' => MailchimpGetAudience::class,
                'type' => 'read',
                'name' => 'Get Audience',
                'description' => 'Get details for a single Mailchimp audience.',
                'icon' => 'ph:users',
            ],
            'mailchimp_create_audience' => [
                'class' => MailchimpCreateAudience::class,
                'type' => 'write',
                'name' => 'Create Audience',
                'description' => 'Create a new Mailchimp audience.',
                'icon' => 'ph:users',
            ],
            'mailchimp_add_subscriber' => [
                'class' => MailchimpAddSubscriber::class,
                'type' => 'write',
                'name' => 'Add Subscriber',
                'description' => 'Add or update a subscriber in a Mailchimp audience.',
                'icon' => 'ph:user-plus',
            ],
            'mailchimp_get_subscriber' => [
                'class' => MailchimpGetSubscriber::class,
                'type' => 'read',
                'name' => 'Get Subscriber',
                'description' => 'Get a subscriber\'s details from a Mailchimp audience.',
                'icon' => 'ph:user',
            ],
            'mailchimp_update_subscriber' => [
                'class' => MailchimpUpdateSubscriber::class,
                'type' => 'write',
                'name' => 'Update Subscriber',
                'description' => 'Update a subscriber\'s details in a Mailchimp audience.',
                'icon' => 'ph:pencil-simple',
            ],
            'mailchimp_search_subscribers' => [
                'class' => MailchimpSearchSubscribers::class,
                'type' => 'read',
                'name' => 'Search Subscribers',
                'description' => 'Search for subscribers across Mailchimp audiences.',
                'icon' => 'ph:magnifying-glass',
            ],
            'mailchimp_remove_subscriber' => [
                'class' => MailchimpRemoveSubscriber::class,
                'type' => 'write',
                'name' => 'Remove Subscriber',
                'description' => 'Remove (archive) a subscriber from a Mailchimp audience.',
                'icon' => 'ph:user-minus',
            ],
            'mailchimp_create_campaign' => [
                'class' => MailchimpCreateCampaign::class,
                'type' => 'write',
                'name' => 'Create Campaign',
                'description' => 'Create a new Mailchimp campaign.',
                'icon' => 'ph:envelope',
            ],
            'mailchimp_get_campaign' => [
                'class' => MailchimpGetCampaign::class,
                'type' => 'read',
                'name' => 'Get Campaign',
                'description' => 'Get details for a single Mailchimp campaign.',
                'icon' => 'ph:envelope',
            ],
            'mailchimp_update_campaign' => [
                'class' => MailchimpUpdateCampaign::class,
                'type' => 'write',
                'name' => 'Update Campaign',
                'description' => 'Update a Mailchimp campaign\'s settings.',
                'icon' => 'ph:pencil-simple',
            ],
            'mailchimp_send_campaign' => [
                'class' => MailchimpSendCampaign::class,
                'type' => 'write',
                'name' => 'Send Campaign',
                'description' => 'Send a Mailchimp campaign immediately.',
                'icon' => 'ph:paper-plane-tilt',
            ],
            'mailchimp_list_campaigns' => [
                'class' => MailchimpListCampaigns::class,
                'type' => 'read',
                'name' => 'List Campaigns',
                'description' => 'List Mailchimp campaigns with optional filters.',
                'icon' => 'ph:envelope',
            ],
            'mailchimp_tag_subscriber' => [
                'class' => MailchimpTagSubscriber::class,
                'type' => 'write',
                'name' => 'Tag Subscriber',
                'description' => 'Add or remove tags on a Mailchimp subscriber.',
                'icon' => 'ph:tag',
            ],
            'mailchimp_list_segments' => [
                'class' => MailchimpListSegments::class,
                'type' => 'read',
                'name' => 'List Segments',
                'description' => 'List all segments for a Mailchimp audience.',
                'icon' => 'ph:funnel',
            ],
            'mailchimp_add_to_segment' => [
                'class' => MailchimpAddToSegment::class,
                'type' => 'write',
                'name' => 'Add to Segment',
                'description' => 'Add a subscriber to a Mailchimp static segment.',
                'icon' => 'ph:funnel',
            ],
            'mailchimp_get_campaign_report' => [
                'class' => MailchimpGetCampaignReport::class,
                'type' => 'read',
                'name' => 'Get Campaign Report',
                'description' => 'Get send, open, click, and bounce stats for a Mailchimp campaign.',
                'icon' => 'ph:chart-bar',
            ],
            'mailchimp_get_current_user' => [
                'class' => MailchimpGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated Mailchimp user\'s account info.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/mailchimp.md';
    }    public function credentialFields(): array
    {
        return [
            'api_key' => [
                'label' => 'API Key',
                'type' => 'text',
                'required' => true,
                'description' => 'Your Mailchimp API key.',
            ],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /** @param array<string, mixed> $context */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /** @param array<string, mixed> $context */
    private function resolveService(array $context = []): MailchimpService
    {
        $account = $context['account'] ?? null;
        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new MailchimpService(
                apiKey: $creds->get('mailchimp', 'api_key', '', $account),
            );
        }

        return app(MailchimpService::class);
    }
}
