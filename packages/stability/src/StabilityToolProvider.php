<?php

namespace OpenCompany\Integrations\Stability;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Provides Stability AI tools, metadata, and credential setup details.
 *
 * Exposes account, image generation, image editing, upscaling, control, and
 * image-to-video operations from the Stability AI platform API.
 */
class StabilityToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    /**
     * Compact tool definitions for catalog extraction.
     *
     * @var array<string, array{0: string, 1: string, 2: string, 3: string, 4: string}>
     */
    private const TOOL_DEFINITIONS = [
        'stability_get_account' => ['StabilityGetAccount', 'read', 'Get Account', 'Get the account associated with the Stability AI API key.', 'ph:user'],
        'stability_get_balance' => ['StabilityGetBalance', 'read', 'Get Balance', 'Get credit balance for the Stability AI API key.', 'ph:wallet'],
        'stability_generate_core' => ['StabilityGenerateCore', 'write', 'Generate Core Image', 'Generate an image with Stable Image Core.', 'ph:image'],
        'stability_generate_ultra' => ['StabilityGenerateUltra', 'write', 'Generate Ultra Image', 'Generate a high-quality image with Stable Image Ultra.', 'ph:sparkle'],
        'stability_generate_sd3' => ['StabilityGenerateSd3', 'write', 'Generate SD3 Image', 'Generate an image with Stable Diffusion 3 or 3.5 models.', 'ph:image-square'],
        'stability_inpaint' => ['StabilityInpaint', 'write', 'Inpaint Image', 'Fill or replace masked areas of an image.', 'ph:paint-brush'],
        'stability_erase' => ['StabilityErase', 'write', 'Erase Image Area', 'Remove masked areas from an image.', 'ph:eraser'],
        'stability_remove_background' => ['StabilityRemoveBackground', 'write', 'Remove Background', 'Remove an image background.', 'ph:selection-background'],
        'stability_control_structure' => ['StabilityControlStructure', 'write', 'Control Structure', 'Generate an image guided by the structure of an input image.', 'ph:tree-structure'],
        'stability_upscale_fast' => ['StabilityUpscaleFast', 'write', 'Fast Upscale', 'Quickly upscale an image.', 'ph:arrows-out'],
        'stability_upscale_creative' => ['StabilityUpscaleCreative', 'write', 'Creative Upscale', 'Upscale an image with creative enhancement.', 'ph:magic-wand'],
        'stability_image_to_video' => ['StabilityImageToVideo', 'write', 'Image To Video', 'Start an image-to-video generation job.', 'ph:video-camera'],
        'stability_get_video_result' => ['StabilityGetVideoResult', 'read', 'Get Video Result', 'Fetch the result of an image-to-video generation job.', 'ph:film-strip'],
    ];

    /**
     * Describe setup and runtime support for host catalogs.
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
                'token_keys' => ['api_key'],
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
        return 'stability';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Stability AI',
            'description' => 'Image and video generation APIs',
            'icon' => 'ph:sparkle',
            'logo' => 'simple-icons:stabilityai',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Stability AI',
            'description' => 'Generate, edit, upscale, and animate images using Stability AI platform APIs.',
            'icon' => 'ph:sparkle',
            'logo' => 'simple-icons:stabilityai',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://platform.stability.ai/docs/api-reference',
            'source_url' => 'https://platform.stability.ai/docs/api-reference',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'sk-...',
                'hint' => 'Create a Stability AI API key in the Stability platform account dashboard.',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.stability.ai',
                'default' => 'https://api.stability.ai',
            ],
        ];
    }

    /**
     * Test the API key by reading the account balance endpoint.
     *
     * @param  array<string, mixed>  $config  Credential and endpoint settings.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = (string) ($config['api_key'] ?? '');
        $baseUrl = rtrim((string) ($config['url'] ?? 'https://api.stability.ai'), '/');

        if ($apiKey === '') {
            return ['success' => false, 'error' => 'Stability AI API key is required.'];
        }

        try {
            $response = Http::withToken($apiKey)->acceptJson()->timeout(10)->get($baseUrl . '/v1/user/balance');

            if (!$response->successful()) {
                return ['success' => false, 'error' => 'Stability AI API returned HTTP ' . $response->status() . '.'];
            }

            return ['success' => true, 'message' => 'Connected to Stability AI.'];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /** @return array<string, string> */
    public function validationRules(): array
    {
        return [
            'api_key' => 'required|string',
            'url' => 'nullable|url',
        ];
    }

    /** @return array<int, array<string, mixed>> */
    public function credentialFields(): array
    {
        return $this->configSchema();
    }

    /**
     * Return Stability AI tool metadata.
     *
     * @return array<string, array<string, mixed>>
     */
    public function tools(): array
    {
        $tools = [];

        foreach (self::TOOL_DEFINITIONS as $slug => [$class, $type, $name, $description, $icon]) {
            $tools[$slug] = [
                'class' => __NAMESPACE__ . '\\Tools\\' . $class,
                'type' => $type,
                'name' => $name,
                'description' => $description,
                'icon' => $icon,
            ];
        }

        return $tools;
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/stability.md';
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a Stability tool with default or account-specific credentials.
     *
     * @param  class-string<Tool>  $class  Tool class name.
     * @param  array<string, mixed>  $context  Optional context containing an account key.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new $class(new StabilityService(
                apiKey: (string) $creds->get('stability', 'api_key', '', (string) $account),
                baseUrl: (string) $creds->get('stability', 'url', 'https://api.stability.ai', (string) $account),
            ));
        }

        return new $class(app(StabilityService::class));
    }
}
