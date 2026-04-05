<?php

namespace OpenCompany\Integrations\Figma;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Figma\Tools\FigmaDeleteComment;
use OpenCompany\Integrations\Figma\Tools\FigmaGetComments;
use OpenCompany\Integrations\Figma\Tools\FigmaGetComponent;
use OpenCompany\Integrations\Figma\Tools\FigmaGetComponents;
use OpenCompany\Integrations\Figma\Tools\FigmaGetFile;
use OpenCompany\Integrations\Figma\Tools\FigmaGetFileImages;
use OpenCompany\Integrations\Figma\Tools\FigmaGetFileNodes;
use OpenCompany\Integrations\Figma\Tools\FigmaGetImageFills;
use OpenCompany\Integrations\Figma\Tools\FigmaGetMe;
use OpenCompany\Integrations\Figma\Tools\FigmaGetProjectFiles;
use OpenCompany\Integrations\Figma\Tools\FigmaGetStyle;
use OpenCompany\Integrations\Figma\Tools\FigmaGetStyles;
use OpenCompany\Integrations\Figma\Tools\FigmaGetTeamProjects;
use OpenCompany\Integrations\Figma\Tools\FigmaListTeamComponents;
use OpenCompany\Integrations\Figma\Tools\FigmaPostComment;

/**
 * Registers all Figma tools and provides integration metadata.
 *
 * Exposes 15 tools covering files, images, comments, projects,
 * components, and styles via the ToolProvider contract.
 */
class FigmaToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'figma';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'files, images, components, styles',
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
                'key' => 'api_token',
                'type' => 'secret',
                'label' => 'Personal Access Token',
                'placeholder' => 'figd_...',
                'hint' => 'Figma Personal Access Token. Generate one in <strong>Settings → Personal access tokens</strong>.',
                'required' => true,
            ],
        ];
    }

    /**
     * Test the Figma connection using the provided credentials.
     *
     * @param  array<string, mixed>  $config  Configuration containing 'api_token'
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiToken = $config['api_token'] ?? '';

        if (empty($apiToken)) {
            return ['success' => false, 'error' => 'No API token provided. Generate a Personal Access Token in Figma settings.'];
        }

        try {
            $response = Http::withHeaders([
                'X-Figma-Token' => $apiToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get('https://api.figma.com/v1/me');

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
            'api_token' => 'nullable|string',
        ];
    }

    public function tools(): array
    {
        return [
            // Files
            'figma_get_file' => [
                'class' => FigmaGetFile::class,
                'type' => 'read',
                'name' => 'Get File',
                'description' => 'Get a Figma file by key.',
                'icon' => 'ph:file',
            ],
            'figma_get_file_nodes' => [
                'class' => FigmaGetFileNodes::class,
                'type' => 'read',
                'name' => 'Get File Nodes',
                'description' => 'Get specific nodes from a Figma file.',
                'icon' => 'ph:tree-structure',
            ],
            // Images
            'figma_get_file_images' => [
                'class' => FigmaGetFileImages::class,
                'type' => 'read',
                'name' => 'Get File Images',
                'description' => 'Export images from a Figma file.',
                'icon' => 'ph:image',
            ],
            'figma_get_image_fills' => [
                'class' => FigmaGetImageFills::class,
                'type' => 'read',
                'name' => 'Get Image Fills',
                'description' => 'Get image fill metadata for a Figma file.',
                'icon' => 'ph:paint-bucket',
            ],
            // Comments
            'figma_get_comments' => [
                'class' => FigmaGetComments::class,
                'type' => 'read',
                'name' => 'Get Comments',
                'description' => 'List comments on a Figma file.',
                'icon' => 'ph:chat-circle-dots',
            ],
            'figma_post_comment' => [
                'class' => FigmaPostComment::class,
                'type' => 'write',
                'name' => 'Post Comment',
                'description' => 'Post a comment on a Figma file.',
                'icon' => 'ph:chat-circle-plus',
            ],
            'figma_delete_comment' => [
                'class' => FigmaDeleteComment::class,
                'type' => 'write',
                'name' => 'Delete Comment',
                'description' => 'Delete a comment from a Figma file.',
                'icon' => 'ph:trash',
            ],
            // Teams & Projects
            'figma_get_team_projects' => [
                'class' => FigmaGetTeamProjects::class,
                'type' => 'read',
                'name' => 'Get Team Projects',
                'description' => 'List projects in a Figma team.',
                'icon' => 'ph:folder',
            ],
            'figma_get_project_files' => [
                'class' => FigmaGetProjectFiles::class,
                'type' => 'read',
                'name' => 'Get Project Files',
                'description' => 'List files in a Figma project.',
                'icon' => 'ph:folders',
            ],
            // Styles & Components
            'figma_get_styles' => [
                'class' => FigmaGetStyles::class,
                'type' => 'read',
                'name' => 'Get Styles',
                'description' => 'List styles in a Figma file.',
                'icon' => 'ph:palette',
            ],
            'figma_get_components' => [
                'class' => FigmaGetComponents::class,
                'type' => 'read',
                'name' => 'Get Components',
                'description' => 'List components in a Figma file.',
                'icon' => 'ph:puzzle-piece',
            ],
            'figma_get_component' => [
                'class' => FigmaGetComponent::class,
                'type' => 'read',
                'name' => 'Get Component',
                'description' => 'Get a Figma component by key.',
                'icon' => 'ph:puzzle-piece',
            ],
            'figma_get_style' => [
                'class' => FigmaGetStyle::class,
                'type' => 'read',
                'name' => 'Get Style',
                'description' => 'Get a Figma style by key.',
                'icon' => 'ph:paint-brush',
            ],
            'figma_list_team_components' => [
                'class' => FigmaListTeamComponents::class,
                'type' => 'read',
                'name' => 'List Team Components',
                'description' => 'List published components in a Figma team.',
                'icon' => 'ph:stack',
            ],
            // Auth
            'figma_get_me' => [
                'class' => FigmaGetMe::class,
                'type' => 'read',
                'name' => 'Get Me',
                'description' => 'Get the authenticated Figma user profile.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/figma.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_token', 'type' => 'secret', 'label' => 'Personal Access Token', 'required' => true],
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
                apiToken: $creds->get('figma', 'api_token', '', $account),
            );
        }

        return app(FigmaService::class);
    }
}
