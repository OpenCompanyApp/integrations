<?php

namespace OpenCompany\Integrations\Ashby;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Ashby\Tools\AshbyListApplications;
use OpenCompany\Integrations\Ashby\Tools\AshbyGetApplication;
use OpenCompany\Integrations\Ashby\Tools\AshbyListJobs;
use OpenCompany\Integrations\Ashby\Tools\AshbyGetJob;
use OpenCompany\Integrations\Ashby\Tools\AshbyListInterviews;
use OpenCompany\Integrations\Ashby\Tools\AshbyGetInterview;
use OpenCompany\Integrations\Ashby\Tools\AshbyGetCurrentUser;

/**
 * Tool provider for the Ashby ATS integration.
 *
 * Registers all Ashby tools with the integration registry and provides
 * configuration schema, connection testing, and multi-account support.
 */
class AshbyToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'ashby';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'jobs, applications, interviews',
            'description' => 'Applicant tracking system',
            'icon' => 'ph:briefcase',
            'logo' => 'simple-icons:ashby',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Ashby',
            'description' => 'Modern applicant tracking system for growing companies',
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
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Ashby API access token',
                'hint' => 'Generate an API key in your Ashby account settings under "Integrations → API"',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.ashbyhq.com',
                'hint' => 'Use the default <code>https://api.ashbyhq.com</code> unless using a custom endpoint',
                'default' => 'https://api.ashbyhq.com',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.ashbyhq.com', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->post($baseUrl . '/api/v1/user.me');

            if (!$response->successful()) {
                $error = $response->json('errors') ?? $response->json('error') ?? "HTTP {$response->status()}";
                return [
                    'success' => false,
                    'error' => is_string($error) ? $error : json_encode($error),
                ];
            }

            $user = $response->json('results') ?? $response->json();

            return [
                'success' => true,
                'message' => "Connected to Ashby API." . (isset($user['email']) ? " Logged in as {$user['email']}." : ''),
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

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
            'ashby_list_applications' => [
                'class' => AshbyListApplications::class,
                'type' => 'read',
                'name' => 'List Applications',
                'description' => 'List job applications with optional filters.',
                'icon' => 'ph:clipboard-text',
            ],
            'ashby_get_application' => [
                'class' => AshbyGetApplication::class,
                'type' => 'read',
                'name' => 'Get Application',
                'description' => 'Get details for a specific application.',
                'icon' => 'ph:clipboard-text',
            ],
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
                'description' => 'Get details for a specific job.',
                'icon' => 'ph:briefcase',
            ],
            'ashby_list_interviews' => [
                'class' => AshbyListInterviews::class,
                'type' => 'read',
                'name' => 'List Interviews',
                'description' => 'List scheduled interviews.',
                'icon' => 'ph:calendar',
            ],
            'ashby_get_interview' => [
                'class' => AshbyGetInterview::class,
                'type' => 'read',
                'name' => 'Get Interview',
                'description' => 'Get details for a specific interview.',
                'icon' => 'ph:calendar',
            ],
            'ashby_get_current_user' => [
                'class' => AshbyGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated Ashby user profile.',
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
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.ashbyhq.com'],
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
                accessToken: $creds->get('ashby', 'access_token', '', $account),
                baseUrl: $creds->get('ashby', 'url', 'https://api.ashbyhq.com', $account),
            );

            return new $class($service);
        }

        return new $class(app(AshbyService::class));
    }
}
