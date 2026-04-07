<?php

namespace OpenCompany\Integrations\Fal;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Fal\Tools\FalListModels;
use OpenCompany\Integrations\Fal\Tools\FalSubmitRequest;
use OpenCompany\Integrations\Fal\Tools\FalGetRequestStatus;
use OpenCompany\Integrations\Fal\Tools\FalGetResult;
use OpenCompany\Integrations\Fal\Tools\FalListFiles;
use OpenCompany\Integrations\Fal\Tools\FalUploadFile;
use OpenCompany\Integrations\Fal\Tools\FalGetCurrentUser;

class FalToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'fal';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'models, generation, files',
            'description' => 'AI media generation',
            'icon' => 'ph:sparkle',
            'logo' => 'simple-icons:fal',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'fal.ai',
            'description' => 'Generate images, videos, audio and more with AI models on fal.ai — fast queue-based inference platform',
            'icon' => 'ph:sparkle',
            'logo' => 'simple-icons:fal',
            'category' => 'ai',
            'badge' => 'verified',
            'docs_url' => 'https://fal.ai/docs',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your fal.ai API key',
                'hint' => 'Find your API key at <b>fal.ai/dashboard/keys</b>',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://queue.fal.run',
                'hint' => 'Defaults to <code>https://queue.fal.run</code>. Change only for custom endpoints.',
                'default' => 'https://queue.fal.run',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://queue.fal.run', '/');

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withToken($apiKey)
                ->withHeaders(['Content-Type' => 'application/json'])
                ->timeout(10)
                ->get($baseUrl . '/user');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach fal.ai API at {$baseUrl}. Check the URL.",
                ];
            }

            if (!$response->successful()) {
                $error = $json['detail'] ?? $json['error'] ?? 'Unknown error';
                return ['success' => false, 'error' => "API error: {$error}"];
            }

            $name = $json['name'] ?? $json['email'] ?? 'fal.ai';

            return [
                'success' => true,
                'message' => "Connected to fal.ai as {$name}.",
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
            'fal_list_models' => [
                'class' => FalListModels::class,
                'type' => 'read',
                'name' => 'List Models',
                'description' => 'List available fal.ai models.',
                'icon' => 'ph:cube',
            ],
            'fal_submit_request' => [
                'class' => FalSubmitRequest::class,
                'type' => 'write',
                'name' => 'Submit Request',
                'description' => 'Submit a generation request to a fal.ai model.',
                'icon' => 'ph:play',
            ],
            'fal_get_request_status' => [
                'class' => FalGetRequestStatus::class,
                'type' => 'read',
                'name' => 'Get Request Status',
                'description' => 'Get the status of a submitted fal.ai request.',
                'icon' => 'ph:spinner',
            ],
            'fal_get_result' => [
                'class' => FalGetResult::class,
                'type' => 'read',
                'name' => 'Get Result',
                'description' => 'Get the result of a completed fal.ai request.',
                'icon' => 'ph:download-simple',
            ],
            'fal_list_files' => [
                'class' => FalListFiles::class,
                'type' => 'read',
                'name' => 'List Files',
                'description' => 'List files stored in fal.ai storage.',
                'icon' => 'ph:folder-open',
            ],
            'fal_upload_file' => [
                'class' => FalUploadFile::class,
                'type' => 'write',
                'name' => 'Upload File',
                'description' => 'Upload a file to fal.ai storage.',
                'icon' => 'ph:upload-simple',
            ],
            'fal_get_current_user' => [
                'class' => FalGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get current user profile and account information.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/fal.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://queue.fal.run'],
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

            $service = new FalService(
                apiKey: $creds->get('fal', 'api_key', '', $account),
                baseUrl: $creds->get('fal', 'url', 'https://queue.fal.run', $account),
            );

            return new $class($service);
        }

        return new $class(app(FalService::class));
    }
}
