<?php

namespace OpenCompany\Integrations\Ashby;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Ashby\Tools\AshbyListJobs;
use OpenCompany\Integrations\Ashby\Tools\AshbyGetJob;
use OpenCompany\Integrations\Ashby\Tools\AshbyListApplications;
use OpenCompany\Integrations\Ashby\Tools\AshbyGetApplication;
use OpenCompany\Integrations\Ashby\Tools\AshbyListCandidates;
use OpenCompany\Integrations\Ashby\Tools\AshbyCreateNote;
use OpenCompany\Integrations\Ashby\Tools\AshbyListInterviews;
use OpenCompany\Integrations\Ashby\Tools\AshbyGetCurrentUser;

class AshbyToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'ashby';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'jobs, applications, candidates, interviews',
            'description' => 'ATS & recruiting',
            'icon' => 'ph:briefcase',
            'logo' => 'simple-icons:ashby',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Ashby',
            'description' => 'Modern ATS and recruiting platform',
            'icon' => 'ph:briefcase',
            'logo' => 'simple-icons:ashby',
            'category' => 'hr',
            'badge' => 'verified',
            'docs_url' => 'https://developers.ashbyhq.com',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Ashby API key',
                'hint' => 'Generate an API key in your Ashby account settings under "Integrations" → "API Keys"',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.ashbyhq.com',
                'hint' => 'Use <code>https://api.ashbyhq.com</code> unless you have a custom endpoint',
                'default' => 'https://api.ashbyhq.com',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.ashbyhq.com', '/');

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->withBasicAuth($apiKey, '')->timeout(10)->post($baseUrl . '/user.getInfo');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Ashby API at {$baseUrl}. Check the URL.",
                ];
            }

            if (!$response->successful()) {
                return [
                    'success' => false,
                    'error' => "Authentication failed (HTTP {$response->status()}). Check your API key.",
                ];
            }

            return [
                'success' => true,
                'message' => "Connected to Ashby API at {$baseUrl}.",
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
            'ashby_list_jobs' => [
                'class' => AshbyListJobs::class,
                'type' => 'read',
                'name' => 'List Jobs',
                'description' => 'List open and closed job postings.',
                'icon' => 'ph:briefcase',
            ],
            'ashby_get_job' => [
                'class' => AshbyGetJob::class,
                'type' => 'read',
                'name' => 'Get Job',
                'description' => 'Get detailed information about a specific job.',
                'icon' => 'ph:briefcase',
            ],
            'ashby_list_applications' => [
                'class' => AshbyListApplications::class,
                'type' => 'read',
                'name' => 'List Applications',
                'description' => 'List job applications with filters.',
                'icon' => 'ph:file-text',
            ],
            'ashby_get_application' => [
                'class' => AshbyGetApplication::class,
                'type' => 'read',
                'name' => 'Get Application',
                'description' => 'Get detailed information about a specific application.',
                'icon' => 'ph:file-text',
            ],
            'ashby_list_candidates' => [
                'class' => AshbyListCandidates::class,
                'type' => 'read',
                'name' => 'List Candidates',
                'description' => 'List candidates in the ATS.',
                'icon' => 'ph:users',
            ],
            'ashby_create_note' => [
                'class' => AshbyCreateNote::class,
                'type' => 'write',
                'name' => 'Create Note',
                'description' => 'Add a note to a candidate, application, or job.',
                'icon' => 'ph:note',
            ],
            'ashby_list_interviews' => [
                'class' => AshbyListInterviews::class,
                'type' => 'read',
                'name' => 'List Interviews',
                'description' => 'List scheduled interviews.',
                'icon' => 'ph:calendar',
            ],
            'ashby_get_current_user' => [
                'class' => AshbyGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get info about the authenticated Ashby user.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/ashby.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'Ashby API URL', 'required' => false, 'default' => 'https://api.ashbyhq.com'],
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

            $service = new AshbyService(
                apiKey: $creds->get('ashby', 'api_key', '', $account),
                baseUrl: $creds->get('ashby', 'url', 'https://api.ashbyhq.com', $account),
            );

            return new $class($service);
        }

        return new $class(app(AshbyService::class));
    }
}
