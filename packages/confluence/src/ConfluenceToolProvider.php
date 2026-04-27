<?php

namespace OpenCompany\Integrations\Confluence;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Confluence\Tools\ConfluenceAddComment;
use OpenCompany\Integrations\Confluence\Tools\ConfluenceAddLabels;
use OpenCompany\Integrations\Confluence\Tools\ConfluenceCreatePage;
use OpenCompany\Integrations\Confluence\Tools\ConfluenceDeletePage;
use OpenCompany\Integrations\Confluence\Tools\ConfluenceGetLabels;
use OpenCompany\Integrations\Confluence\Tools\ConfluenceGetPage;
use OpenCompany\Integrations\Confluence\Tools\ConfluenceGetPageAncestors;
use OpenCompany\Integrations\Confluence\Tools\ConfluenceGetPageChildren;
use OpenCompany\Integrations\Confluence\Tools\ConfluenceGetSpace;
use OpenCompany\Integrations\Confluence\Tools\ConfluenceGetSpaces;
use OpenCompany\Integrations\Confluence\Tools\ConfluenceSearchPages;
use OpenCompany\Integrations\Confluence\Tools\ConfluenceUpdatePage;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
/**
 * Registers the Confluence integration and its tools with the integration platform.
 *
 * Provides page, space, comment, label, and search tools via the
 * Confluence Cloud REST API.
 */
class ConfluenceToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities {

/**
     * Describe host and authentication capabilities for catalog and setup flows.
     *
     * @return array<string, mixed>
     */
    public function integrationCapabilities(): array
    {
        return [
          'auth' => [
            'strategy' => 'api_token',
            'legacy_auth_type' => 'api_token',
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
        return 'confluence';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'pages, spaces, comments, labels, search',
            'description' => 'Confluence integration for knowledge base and documentation',
            'icon' => 'simple-icons:confluence',
            'logo' => 'simple-icons:confluence',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Confluence',
            'description' => 'Manage pages, spaces, comments, and labels on Confluence Cloud.',
            'icon' => 'simple-icons:confluence',
            'logo' => 'simple-icons:confluence',
            'category' => 'productivity',
            'docs_url' => 'https://developer.atlassian.com/cloud/confluence/rest/v1/intro/',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_token',
                'type' => 'secret',
                'label' => 'Personal Access Token',
                'placeholder' => 'ATATT3xFfGF0...',
                'hint' => 'Generate a Personal Access Token at <a href="https://id.atlassian.com/manage-profile/security/api-tokens" target="_blank">Atlassian Account Security → API tokens</a>.',
                'required' => true,
            ],
            [
                'key' => 'base_url',
                'type' => 'text',
                'label' => 'Confluence API Base URL',
                'placeholder' => 'https://mycompany.atlassian.com/wiki/rest/api',
                'hint' => 'Your Confluence Cloud REST API base URL (e.g. https://mycompany.atlassian.com/wiki/rest/api).',
                'required' => true,
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $apiToken = $config['api_token'] ?? '';
        $baseUrl = $config['base_url'] ?? '';

        if (empty($apiToken)) {
            return ['success' => false, 'error' => 'No API token provided.'];
        }

        if (empty($baseUrl)) {
            return ['success' => false, 'error' => 'No Confluence base URL provided.'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => "Bearer {$apiToken}",
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->timeout(10)->get(rtrim($baseUrl, '/') . '/user/current');

            if ($response->successful()) {
                $user = $response->json();
                $displayName = $user['displayName'] ?? 'unknown';

                return [
                    'success' => true,
                    'message' => "Connected to Confluence as {$displayName}.",
                ];
            }

            $body = $response->json() ?? [];
            $error = $body['message'] ?? $response->body();

            return [
                'success' => false,
                'error' => 'Confluence API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error)),
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /** @return array<string, string|array<int, string>> */
    public function validationRules(): array
    {
        return [
            'api_token' => 'nullable|string',
            'base_url' => 'nullable|string|url',
        ];
    }

    public function tools(): array
    {
        return [
            'confluence_create_page' => [
                'class' => ConfluenceCreatePage::class,
                'type' => 'write',
                'name' => 'Create Page',
                'description' => 'Create a new page in a Confluence space.',
                'icon' => 'mdi:file-document-plus-outline',
            ],
            'confluence_get_page' => [
                'class' => ConfluenceGetPage::class,
                'type' => 'read',
                'name' => 'Get Page',
                'description' => 'Get details for a specific Confluence page.',
                'icon' => 'mdi:file-document-outline',
            ],
            'confluence_update_page' => [
                'class' => ConfluenceUpdatePage::class,
                'type' => 'write',
                'name' => 'Update Page',
                'description' => 'Update an existing Confluence page.',
                'icon' => 'mdi:file-document-edit-outline',
            ],
            'confluence_delete_page' => [
                'class' => ConfluenceDeletePage::class,
                'type' => 'write',
                'name' => 'Delete Page',
                'description' => 'Delete a Confluence page.',
                'icon' => 'mdi:file-document-minus-outline',
            ],
            'confluence_search_pages' => [
                'class' => ConfluenceSearchPages::class,
                'type' => 'read',
                'name' => 'Search Pages',
                'description' => 'Search for Confluence content using CQL.',
                'icon' => 'mdi:magnify',
            ],
            'confluence_get_page_ancestors' => [
                'class' => ConfluenceGetPageAncestors::class,
                'type' => 'read',
                'name' => 'Get Page Ancestors',
                'description' => 'Get the ancestor (parent) pages of a Confluence page.',
                'icon' => 'mdi:file-tree-outline',
            ],
            'confluence_get_page_children' => [
                'class' => ConfluenceGetPageChildren::class,
                'type' => 'read',
                'name' => 'Get Page Children',
                'description' => 'Get the child pages of a Confluence page.',
                'icon' => 'mdi:file-tree-outline',
            ],
            'confluence_add_comment' => [
                'class' => ConfluenceAddComment::class,
                'type' => 'write',
                'name' => 'Add Comment',
                'description' => 'Add a comment to a Confluence page.',
                'icon' => 'mdi:comment-plus-outline',
            ],
            'confluence_get_spaces' => [
                'class' => ConfluenceGetSpaces::class,
                'type' => 'read',
                'name' => 'Get Spaces',
                'description' => 'List Confluence spaces accessible to the authenticated user.',
                'icon' => 'mdi:folder-outline',
            ],
            'confluence_get_space' => [
                'class' => ConfluenceGetSpace::class,
                'type' => 'read',
                'name' => 'Get Space',
                'description' => 'Get details for a specific Confluence space.',
                'icon' => 'mdi:folder-open-outline',
            ],
            'confluence_get_labels' => [
                'class' => ConfluenceGetLabels::class,
                'type' => 'read',
                'name' => 'Get Labels',
                'description' => 'Get labels for a Confluence page.',
                'icon' => 'mdi:tag-outline',
            ],
            'confluence_add_labels' => [
                'class' => ConfluenceAddLabels::class,
                'type' => 'write',
                'name' => 'Add Labels',
                'description' => 'Add labels to a Confluence page.',
                'icon' => 'mdi:tag-plus-outline',
            ],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    public function luaDocsPath(): ?string
    {
        return dirname(__DIR__) . '/lua-docs/confluence.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'api_token', 'type' => 'secret', 'label' => 'Personal Access Token', 'required' => true],
            ['key' => 'base_url', 'type' => 'text', 'label' => 'Confluence API Base URL', 'required' => true],
        ];
    }

    /** @param  array<string, mixed>  $context */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new ConfluenceService(
                apiToken: $creds->get('confluence', 'api_token', '', $account),
                baseUrl: $creds->get('confluence', 'base_url', 'https://your-domain.atlassian.com/wiki/rest/api', $account),
            );

            return new $class($service);
        }

        return new $class(app(ConfluenceService::class));
    }
}
