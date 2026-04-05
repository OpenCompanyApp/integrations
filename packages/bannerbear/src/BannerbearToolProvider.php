<?php

namespace OpenCompany\Integrations\Bannerbear;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Bannerbear\Tools\BannerbearCreateImage;
use OpenCompany\Integrations\Bannerbear\Tools\BannerbearCreateAnimatedGif;
use OpenCompany\Integrations\Bannerbear\Tools\BannerbearCreateVideo;
use OpenCompany\Integrations\Bannerbear\Tools\BannerbearGetCurrentUser;
use OpenCompany\Integrations\Bannerbear\Tools\BannerbearGetImage;
use OpenCompany\Integrations\Bannerbear\Tools\BannerbearGetTemplate;
use OpenCompany\Integrations\Bannerbear\Tools\BannerbearGetVideo;
use OpenCompany\Integrations\Bannerbear\Tools\BannerbearListTemplates;

class BannerbearToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'bannerbear';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'images, videos, gifs, templates',
            'description' => 'Automated media generation',
            'icon' => 'ph:image',
            'logo' => 'simple-icons:bannerbear',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Bannerbear',
            'description' => 'Automated image, video, and GIF generation from templates',
            'icon' => 'ph:image',
            'logo' => 'simple-icons:bannerbear',
            'category' => 'design',
            'badge' => 'verified',
            'docs_url' => 'https://developers.bannerbear.com/',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Bannerbear API key',
                'hint' => 'Find your API key in the Bannerbear dashboard under Settings > API Key',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.bannerbear.com/v2',
                'hint' => 'Use the default Bannerbear API URL, or override for a custom endpoint',
                'default' => 'https://api.bannerbear.com/v2',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.bannerbear.com/v2', '/');

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/account');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Bannerbear API at {$baseUrl}. Check the URL.",
                ];
            }

            if (!$response->successful()) {
                $error = $json['error'] ?? $json['message'] ?? "HTTP {$response->status()}";
                return [
                    'success' => false,
                    'error' => "Bannerbear API error: {$error}",
                ];
            }

            $name = $json['name'] ?? 'Unknown';

            return [
                'success' => true,
                'message' => "Connected to Bannerbear as {$name}.",
            ];
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
            'bannerbear_create_image' => [
                'class' => BannerbearCreateImage::class,
                'type' => 'write',
                'name' => 'Create Image',
                'description' => 'Generate an image from a Bannerbear template with custom modifications.',
                'icon' => 'ph:image',
            ],
            'bannerbear_get_image' => [
                'class' => BannerbearGetImage::class,
                'type' => 'read',
                'name' => 'Get Image',
                'description' => 'Retrieve the status and URL of a previously created image.',
                'icon' => 'ph:image',
            ],
            'bannerbear_create_video' => [
                'class' => BannerbearCreateVideo::class,
                'type' => 'write',
                'name' => 'Create Video',
                'description' => 'Generate a video from a Bannerbear template with custom modifications.',
                'icon' => 'ph:video',
            ],
            'bannerbear_get_video' => [
                'class' => BannerbearGetVideo::class,
                'type' => 'read',
                'name' => 'Get Video',
                'description' => 'Retrieve the status and URL of a previously created video.',
                'icon' => 'ph:video',
            ],
            'bannerbear_list_templates' => [
                'class' => BannerbearListTemplates::class,
                'type' => 'read',
                'name' => 'List Templates',
                'description' => 'List all available Bannerbear templates.',
                'icon' => 'ph:layouts',
            ],
            'bannerbear_get_template' => [
                'class' => BannerbearGetTemplate::class,
                'type' => 'read',
                'name' => 'Get Template',
                'description' => 'Get details and modification layers for a specific Bannerbear template.',
                'icon' => 'ph:layouts',
            ],
            'bannerbear_create_animated_gif' => [
                'class' => BannerbearCreateAnimatedGif::class,
                'type' => 'write',
                'name' => 'Create Animated GIF',
                'description' => 'Generate an animated GIF from a Bannerbear template.',
                'icon' => 'ph:filmstrip',
            ],
            'bannerbear_get_current_user' => [
                'class' => BannerbearGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated Bannerbear account details.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/bannerbear.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.bannerbear.com/v2'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new BannerbearService(
                apiKey: $creds->get('bannerbear', 'api_key', '', $account),
                baseUrl: $creds->get('bannerbear', 'url', 'https://api.bannerbear.com/v2', $account),
            );

            return new $class($service);
        }

        return new $class(app(BannerbearService::class));
    }
}
