<?php

namespace OpenCompany\Integrations\Figma;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Figma\Tools\FigmaDeleteComment;
use OpenCompany\Integrations\Figma\Tools\FigmaGetCurrentUser;
use OpenCompany\Integrations\Figma\Tools\FigmaGetComponent;
use OpenCompany\Integrations\Figma\Tools\FigmaGetComments;
use OpenCompany\Integrations\Figma\Tools\FigmaGetFile;
use OpenCompany\Integrations\Figma\Tools\FigmaGetFileImages;
use OpenCompany\Integrations\Figma\Tools\FigmaGetFileNodes;
use OpenCompany\Integrations\Figma\Tools\FigmaGetImageFills;
use OpenCompany\Integrations\Figma\Tools\FigmaGetMe;
use OpenCompany\Integrations\Figma\Tools\FigmaGetProjectFiles;
use OpenCompany\Integrations\Figma\Tools\FigmaGetStyle;
use OpenCompany\Integrations\Figma\Tools\FigmaGetStyles;
use OpenCompany\Integrations\Figma\Tools\FigmaGetTeamProjects;
use OpenCompany\Integrations\Figma\Tools\FigmaListComments;
use OpenCompany\Integrations\Figma\Tools\FigmaListComponents;
use OpenCompany\Integrations\Figma\Tools\FigmaListFiles;
use OpenCompany\Integrations\Figma\Tools\FigmaListProjects;
use OpenCompany\Integrations\Figma\Tools\FigmaListTeamComponents;
use OpenCompany\Integrations\Figma\Tools\FigmaPostComment;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\Integrations\Figma\Tools\FigmaGetComponents;
/**
 * Registers all Figma tools and provides integration metadata.
 *
 * Exposes 19 tools covering files, images, comments, projects,
 * components, and styles via the ToolProvider contract.
 * Supports multi-account via ConfigurableIntegration.
 */
class FigmaToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities {

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
            'setup_flows' =>
            [
              0 => 'manual_token',
            ],
            'requires_browser_for_setup' => false,
            'refreshable' => false,
            'token_keys' =>
            [
              0 => 'access_token',
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
              'setup_mode' => 'manual_token',
            ],
            'cli' =>
            [
              'setup_supported' => true,
              'runtime_supported' => true,
              'setup_mode' => 'manual_token',
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
        return 'figma';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Figma',
            'description' => 'Design',
            'icon' => 'ph:figma-logo',
            'logo' => 'simple-icons:figma',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Figma',
            'description' => 'Files, images, comments, projects, components, and styles',
            'icon' => 'ph:figma-logo',
            'logo' => 'simple-icons:figma',
            'category' => 'design',
            'badge' => 'verified',
            'docs_url' => 'https://www.figma.com/developers/api',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Personal Access Token',
                'placeholder' => 'figd_...',
                'hint' => 'Figma Personal Access Token. Generate one in <strong>Settings → Personal access tokens</strong>.',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.figma.com',
                'hint' => 'The Figma API base URL. Change only if using a proxy or custom endpoint.',
                'default' => 'https://api.figma.com',
            ],
        ];
    }

    /**
     * Test the Figma connection using the provided credentials.
     *
     * @param  array<string, mixed>  $config  Configuration containing 'access_token' and optionally 'url'
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.figma.com', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided. Generate a Personal Access Token in Figma settings.'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/v1/me');

            if (! $response->successful()) {
                $status = $response->status();
                $body = $response->json() ?? [];

                return [
                    'success' => false,
                    'error' => 'Figma API error (' . $status . '): ' . ($body['message'] ?? $response->body()),
                ];
            }

            $body = $response->json() ?? [];
            $name = trim(($body['first_name'] ?? '') . ' ' . ($body['last_name'] ?? ''));
            $email = $body['email'] ?? 'Unknown';

            return [
                'success' => true,
                'message' => "Connected to Figma as {$name} ({$email}).",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /** @return array<string, string> */
    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

        public function tools(): array
    {
        return [
            'figma_delete_comment' => [
                'class' => FigmaDeleteComment::class,
                'type' => 'write',
                'name' => 'Delete Comment',
                'description' => 'Delete a comment from a Figma file.',
                'icon' => 'ph:wrench',
            ],
            'figma_get_comments' => [
                'class' => FigmaGetComments::class,
                'type' => 'read',
                'name' => 'Get Comments',
                'description' => 'List all comments on a Figma file.',
                'icon' => 'ph:wrench',
            ],
            'figma_get_component' => [
                'class' => FigmaGetComponent::class,
                'type' => 'read',
                'name' => 'Get Component',
                'description' => 'Get a Figma component by its key.',
                'icon' => 'ph:wrench',
            ],
            'figma_get_components' => [
                'class' => FigmaGetComponents::class,
                'type' => 'read',
                'name' => 'Get Components',
                'description' => 'List all components in a Figma file.',
                'icon' => 'ph:wrench',
            ],
            'figma_get_current_user' => [
                'class' => FigmaGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated Figma user profile. Returns name, email, and account details.',
                'icon' => 'ph:wrench',
            ],
            'figma_get_file' => [
                'class' => FigmaGetFile::class,
                'type' => 'read',
                'name' => 'Get File',
                'description' => 'Get a Figma file by key. Returns the document tree with pages and nodes.',
                'icon' => 'ph:wrench',
            ],
            'figma_get_file_images' => [
                'class' => FigmaGetFileImages::class,
                'type' => 'read',
                'name' => 'Get File Images',
                'description' => 'Export images from Figma nodes in a file. Returns image download URLs.',
                'icon' => 'ph:wrench',
            ],
            'figma_get_file_nodes' => [
                'class' => FigmaGetFileNodes::class,
                'type' => 'read',
                'name' => 'Get File Nodes',
                'description' => 'Get specific nodes from a Figma file by node IDs.',
                'icon' => 'ph:wrench',
            ],
            'figma_get_image_fills' => [
                'class' => FigmaGetImageFills::class,
                'type' => 'read',
                'name' => 'Get Image Fills',
                'description' => 'Get image fill metadata for a Figma file. Returns image URLs for all image fills.',
                'icon' => 'ph:wrench',
            ],
            'figma_get_me' => [
                'class' => FigmaGetMe::class,
                'type' => 'read',
                'name' => 'Get Me',
                'description' => 'Get the authenticated Figma user profile.',
                'icon' => 'ph:wrench',
            ],
            'figma_get_project_files' => [
                'class' => FigmaGetProjectFiles::class,
                'type' => 'read',
                'name' => 'Get Project Files',
                'description' => 'List all files in a Figma project.',
                'icon' => 'ph:wrench',
            ],
            'figma_get_style' => [
                'class' => FigmaGetStyle::class,
                'type' => 'read',
                'name' => 'Get Style',
                'description' => 'Get a Figma style by its key.',
                'icon' => 'ph:wrench',
            ],
            'figma_get_styles' => [
                'class' => FigmaGetStyles::class,
                'type' => 'read',
                'name' => 'Get Styles',
                'description' => 'List all styles in a Figma file.',
                'icon' => 'ph:wrench',
            ],
            'figma_get_team_projects' => [
                'class' => FigmaGetTeamProjects::class,
                'type' => 'read',
                'name' => 'Get Team Projects',
                'description' => 'List all projects in a Figma team.',
                'icon' => 'ph:wrench',
            ],
            'figma_list_comments' => [
                'class' => FigmaListComments::class,
                'type' => 'read',
                'name' => 'List Comments',
                'description' => 'List all comments on a Figma file. Includes authors, positions, and reply threads.',
                'icon' => 'ph:wrench',
            ],
            'figma_list_components' => [
                'class' => FigmaListComponents::class,
                'type' => 'read',
                'name' => 'List Components',
                'description' => 'List all components in a Figma file. Returns component names, keys, and descriptions.',
                'icon' => 'ph:wrench',
            ],
            'figma_list_files' => [
                'class' => FigmaListFiles::class,
                'type' => 'read',
                'name' => 'List Files',
                'description' => 'List Figma files accessible to the authenticated user. Returns file names, keys, and thumbnails with pagination support.',
                'icon' => 'ph:wrench',
            ],
            'figma_list_projects' => [
                'class' => FigmaListProjects::class,
                'type' => 'read',
                'name' => 'List Projects',
                'description' => 'List all projects in a Figma team. Returns project names and IDs.',
                'icon' => 'ph:wrench',
            ],
            'figma_list_team_components' => [
                'class' => FigmaListTeamComponents::class,
                'type' => 'read',
                'name' => 'List Team Components',
                'description' => 'List published components in a Figma team.',
                'icon' => 'ph:wrench',
            ],
            'figma_post_comment' => [
                'class' => FigmaPostComment::class,
                'type' => 'read',
                'name' => 'Post Comment',
                'description' => 'Post a comment on a Figma file. Can be a top-level comment or a reply.',
                'icon' => 'ph:wrench',
            ],
        ];
    }


    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/figma.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Personal Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.figma.com'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /** @param  array<string, mixed>  $context */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the FigmaService, with optional account-specific credentials.
     *
     * @param  array<string, mixed>  $context
     */
    private function resolveService(array $context = []): FigmaService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            return new FigmaService(
                accessToken: $creds->get('figma', 'access_token', '', $account),
                baseUrl: $creds->get('figma', 'url', 'https://api.figma.com', $account),
            );
        }

        return app(FigmaService::class);
    }
}
