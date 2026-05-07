<?php

namespace OpenCompany\Integrations\Ghost;

use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Ghost\Tools\GhostApiDelete;
use OpenCompany\Integrations\Ghost\Tools\GhostApiGet;
use OpenCompany\Integrations\Ghost\Tools\GhostApiPost;
use OpenCompany\Integrations\Ghost\Tools\GhostApiPut;
use OpenCompany\Integrations\Ghost\Tools\GhostCreateMember;
use OpenCompany\Integrations\Ghost\Tools\GhostCreateOffer;
use OpenCompany\Integrations\Ghost\Tools\GhostCreatePage;
use OpenCompany\Integrations\Ghost\Tools\GhostCreatePost;
use OpenCompany\Integrations\Ghost\Tools\GhostCreateTag;
use OpenCompany\Integrations\Ghost\Tools\GhostCreateTier;
use OpenCompany\Integrations\Ghost\Tools\GhostCreateWebhook;
use OpenCompany\Integrations\Ghost\Tools\GhostDeleteMember;
use OpenCompany\Integrations\Ghost\Tools\GhostDeletePage;
use OpenCompany\Integrations\Ghost\Tools\GhostDeletePost;
use OpenCompany\Integrations\Ghost\Tools\GhostDeleteTag;
use OpenCompany\Integrations\Ghost\Tools\GhostDeleteWebhook;
use OpenCompany\Integrations\Ghost\Tools\GhostGetAuthor;
use OpenCompany\Integrations\Ghost\Tools\GhostGetCurrentUser;
use OpenCompany\Integrations\Ghost\Tools\GhostGetMember;
use OpenCompany\Integrations\Ghost\Tools\GhostGetNewsletter;
use OpenCompany\Integrations\Ghost\Tools\GhostGetOffer;
use OpenCompany\Integrations\Ghost\Tools\GhostGetPage;
use OpenCompany\Integrations\Ghost\Tools\GhostGetPost;
use OpenCompany\Integrations\Ghost\Tools\GhostGetSite;
use OpenCompany\Integrations\Ghost\Tools\GhostGetTag;
use OpenCompany\Integrations\Ghost\Tools\GhostGetTier;
use OpenCompany\Integrations\Ghost\Tools\GhostListAuthors;
use OpenCompany\Integrations\Ghost\Tools\GhostListMembers;
use OpenCompany\Integrations\Ghost\Tools\GhostListNewsletters;
use OpenCompany\Integrations\Ghost\Tools\GhostListOffers;
use OpenCompany\Integrations\Ghost\Tools\GhostListPages;
use OpenCompany\Integrations\Ghost\Tools\GhostListPosts;
use OpenCompany\Integrations\Ghost\Tools\GhostListTags;
use OpenCompany\Integrations\Ghost\Tools\GhostListTiers;
use OpenCompany\Integrations\Ghost\Tools\GhostListWebhooks;
use OpenCompany\Integrations\Ghost\Tools\GhostUpdateMember;
use OpenCompany\Integrations\Ghost\Tools\GhostUpdateOffer;
use OpenCompany\Integrations\Ghost\Tools\GhostUpdatePage;
use OpenCompany\Integrations\Ghost\Tools\GhostUpdatePost;
use OpenCompany\Integrations\Ghost\Tools\GhostUpdateTag;
use OpenCompany\Integrations\Ghost\Tools\GhostUpdateTier;
use OpenCompany\Integrations\Ghost\Tools\GhostUpdateWebhook;

/**
 * Registers Ghost Admin API tools, metadata, credentials, and multi-account service resolution.
 */
class GhostToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'notes' => ['Ghost Admin API keys must be in id:secret format.'],
            ],
            'host_availability' => [
                'web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret'],
                'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret', 'runtime_mode' => 'normal'],
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
        return 'ghost';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Ghost CMS',
            'description' => 'Publishing and membership content',
            'icon' => 'ph:notebook',
            'logo' => 'simple-icons:ghost',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Ghost CMS',
            'description' => 'Ghost posts, pages, tags, authors, members, tiers, offers, newsletters, and webhooks.',
            'icon' => 'ph:notebook',
            'logo' => 'simple-icons:ghost',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://ghost.org/docs/admin-api/',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'Admin API Key',
                'placeholder' => 'key-id:hex-secret',
                'hint' => 'Generate an Admin API key in Ghost Admin > Settings > Integrations > Custom Integration.',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'Admin API Base URL',
                'placeholder' => 'https://yoursite.ghost.io/ghost/api/admin',
                'hint' => 'Use the Admin API base URL, ending in /ghost/api/admin.',
                'required' => true,
            ],
        ];
    }

    /**
     * Test Ghost Admin API credentials with the current user endpoint.
     *
     * @param  array<string, mixed>  $config  Credential configuration.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = (string) ($config['api_key'] ?? '');
        $baseUrl = rtrim((string) ($config['url'] ?? ''), '/');

        if ($apiKey === '') {
            return ['success' => false, 'error' => 'No Admin API key provided.'];
        }

        if ($baseUrl === '') {
            return ['success' => false, 'error' => 'No API base URL provided.'];
        }

        try {
            $user = (new GhostService($apiKey, $baseUrl))->getCurrentUser();
            $name = $user['users'][0]['name'] ?? 'Ghost API';

            return ['success' => true, 'message' => "Connected to {$name}."];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'ghost_list_posts' => $this->tool(GhostListPosts::class, 'read', 'List Posts', 'List posts.'),
            'ghost_get_post' => $this->tool(GhostGetPost::class, 'read', 'Get Post', 'Get one post.'),
            'ghost_create_post' => $this->tool(GhostCreatePost::class, 'write', 'Create Post', 'Create a post.'),
            'ghost_update_post' => $this->tool(GhostUpdatePost::class, 'write', 'Update Post', 'Update a post.'),
            'ghost_delete_post' => $this->tool(GhostDeletePost::class, 'write', 'Delete Post', 'Delete a post.'),
            'ghost_list_pages' => $this->tool(GhostListPages::class, 'read', 'List Pages', 'List pages.'),
            'ghost_get_page' => $this->tool(GhostGetPage::class, 'read', 'Get Page', 'Get one page.'),
            'ghost_create_page' => $this->tool(GhostCreatePage::class, 'write', 'Create Page', 'Create a page.'),
            'ghost_update_page' => $this->tool(GhostUpdatePage::class, 'write', 'Update Page', 'Update a page.'),
            'ghost_delete_page' => $this->tool(GhostDeletePage::class, 'write', 'Delete Page', 'Delete a page.'),
            'ghost_list_tags' => $this->tool(GhostListTags::class, 'read', 'List Tags', 'List tags.'),
            'ghost_get_tag' => $this->tool(GhostGetTag::class, 'read', 'Get Tag', 'Get one tag.'),
            'ghost_create_tag' => $this->tool(GhostCreateTag::class, 'write', 'Create Tag', 'Create a tag.'),
            'ghost_update_tag' => $this->tool(GhostUpdateTag::class, 'write', 'Update Tag', 'Update a tag.'),
            'ghost_delete_tag' => $this->tool(GhostDeleteTag::class, 'write', 'Delete Tag', 'Delete a tag.'),
            'ghost_list_authors' => $this->tool(GhostListAuthors::class, 'read', 'List Authors', 'List authors/users.'),
            'ghost_get_author' => $this->tool(GhostGetAuthor::class, 'read', 'Get Author', 'Get one author/user.'),
            'ghost_list_members' => $this->tool(GhostListMembers::class, 'read', 'List Members', 'List members.'),
            'ghost_get_member' => $this->tool(GhostGetMember::class, 'read', 'Get Member', 'Get one member.'),
            'ghost_create_member' => $this->tool(GhostCreateMember::class, 'write', 'Create Member', 'Create a member.'),
            'ghost_update_member' => $this->tool(GhostUpdateMember::class, 'write', 'Update Member', 'Update a member.'),
            'ghost_delete_member' => $this->tool(GhostDeleteMember::class, 'write', 'Delete Member', 'Delete a member.'),
            'ghost_list_tiers' => $this->tool(GhostListTiers::class, 'read', 'List Tiers', 'List tiers.'),
            'ghost_get_tier' => $this->tool(GhostGetTier::class, 'read', 'Get Tier', 'Get one tier.'),
            'ghost_create_tier' => $this->tool(GhostCreateTier::class, 'write', 'Create Tier', 'Create a tier.'),
            'ghost_update_tier' => $this->tool(GhostUpdateTier::class, 'write', 'Update Tier', 'Update a tier.'),
            'ghost_list_offers' => $this->tool(GhostListOffers::class, 'read', 'List Offers', 'List offers.'),
            'ghost_get_offer' => $this->tool(GhostGetOffer::class, 'read', 'Get Offer', 'Get one offer.'),
            'ghost_create_offer' => $this->tool(GhostCreateOffer::class, 'write', 'Create Offer', 'Create an offer.'),
            'ghost_update_offer' => $this->tool(GhostUpdateOffer::class, 'write', 'Update Offer', 'Update an offer.'),
            'ghost_list_newsletters' => $this->tool(GhostListNewsletters::class, 'read', 'List Newsletters', 'List newsletters.'),
            'ghost_get_newsletter' => $this->tool(GhostGetNewsletter::class, 'read', 'Get Newsletter', 'Get one newsletter.'),
            'ghost_list_webhooks' => $this->tool(GhostListWebhooks::class, 'read', 'List Webhooks', 'List webhooks.'),
            'ghost_create_webhook' => $this->tool(GhostCreateWebhook::class, 'write', 'Create Webhook', 'Create a webhook.'),
            'ghost_update_webhook' => $this->tool(GhostUpdateWebhook::class, 'write', 'Update Webhook', 'Update a webhook.'),
            'ghost_delete_webhook' => $this->tool(GhostDeleteWebhook::class, 'write', 'Delete Webhook', 'Delete a webhook.'),
            'ghost_get_site' => $this->tool(GhostGetSite::class, 'read', 'Get Site', 'Get site metadata.'),
            'ghost_get_current_user' => $this->tool(GhostGetCurrentUser::class, 'read', 'Get Current User', 'Get the authenticated Ghost admin user.'),
            'ghost_api_get' => $this->tool(GhostApiGet::class, 'read', 'API GET', 'Call a relative Ghost Admin API path with GET.'),
            'ghost_api_post' => $this->tool(GhostApiPost::class, 'write', 'API POST', 'Call a relative Ghost Admin API path with POST.'),
            'ghost_api_put' => $this->tool(GhostApiPut::class, 'write', 'API PUT', 'Call a relative Ghost Admin API path with PUT.'),
            'ghost_api_delete' => $this->tool(GhostApiDelete::class, 'write', 'API DELETE', 'Call a relative Ghost Admin API path with DELETE.'),
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/ghost.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'Admin API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'Admin API Base URL', 'required' => true],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /** @param class-string<Tool> $class @param array<string, mixed> $context */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /** @param array<string, mixed> $context */
    private function resolveService(array $context = []): GhostService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new GhostService(
                apiKey: $creds->get('ghost', 'api_key', '', $account),
                baseUrl: $creds->get('ghost', 'url', '', $account),
            );
        }

        return app(GhostService::class);
    }

    /** @param class-string<Tool> $class @return array<string, mixed> */
    private function tool(string $class, string $type, string $name, string $description): array
    {
        return [
            'class' => $class,
            'type' => $type,
            'name' => $name,
            'description' => $description,
            'icon' => $type === 'read' ? 'ph:notebook' : 'ph:pencil-simple',
        ];
    }
}
