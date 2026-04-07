<?php

namespace OpenCompany\Integrations\Speedcurve;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Speedcurve\Tools\SpeedcurveListSites;
use OpenCompany\Integrations\Speedcurve\Tools\SpeedcurveGetSite;
use OpenCompany\Integrations\Speedcurve\Tools\SpeedcurveListTests;
use OpenCompany\Integrations\Speedcurve\Tools\SpeedcurveGetTest;
use OpenCompany\Integrations\Speedcurve\Tools\SpeedcurveListDeployments;
use OpenCompany\Integrations\Speedcurve\Tools\SpeedcurveCreateDeployment;
use OpenCompany\Integrations\Speedcurve\Tools\SpeedcurveGetCurrentUser;

class SpeedcurveToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'speedcurve';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'sites, tests, deployments',
            'description' => 'Performance monitoring',
            'icon' => 'ph:gauge',
            'logo' => 'simple-icons:speedcurve',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'SpeedCurve',
            'description' => 'Front-end performance and Core Web Vitals monitoring',
            'icon' => 'ph:gauge',
            'logo' => 'simple-icons:speedcurve',
            'category' => 'analytics',
            'badge' => 'verified',
            'docs_url' => 'https://api.speedcurve.com/',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your SpeedCurve API key',
                'hint' => 'Find your API key in SpeedCurve under Settings &gt; API',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.speedcurve.com/v1',
                'hint' => 'Override only if using a custom SpeedCurve endpoint',
                'default' => 'https://api.speedcurve.com/v1',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.speedcurve.com/v1', '/');

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withBasicAuth($apiKey, '')
                ->withHeaders([
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                ])
                ->timeout(10)
                ->get($baseUrl . '/user');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach SpeedCurve API at {$baseUrl}. Check the URL.",
                ];
            }

            return [
                'success' => true,
                'message' => "Connected to SpeedCurve API as " . ($json['name'] ?? 'user') . ".",
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
            'speedcurve_list_sites' => [
                'class' => SpeedcurveListSites::class,
                'type' => 'read',
                'name' => 'List Sites',
                'description' => 'List all monitored sites in SpeedCurve.',
                'icon' => 'ph:globe',
            ],
            'speedcurve_get_site' => [
                'class' => SpeedcurveGetSite::class,
                'type' => 'read',
                'name' => 'Get Site',
                'description' => 'Get details for a specific site including URLs and test settings.',
                'icon' => 'ph:globe',
            ],
            'speedcurve_list_tests' => [
                'class' => SpeedcurveListTests::class,
                'type' => 'read',
                'name' => 'List Tests',
                'description' => 'List recent synthetic test results.',
                'icon' => 'ph:flask',
            ],
            'speedcurve_get_test' => [
                'class' => SpeedcurveGetTest::class,
                'type' => 'read',
                'name' => 'Get Test',
                'description' => 'Get detailed results for a specific test run.',
                'icon' => 'ph:flask',
            ],
            'speedcurve_list_deployments' => [
                'class' => SpeedcurveListDeployments::class,
                'type' => 'read',
                'name' => 'List Deployments',
                'description' => 'List recent deployments and their performance impact.',
                'icon' => 'ph:rocket',
            ],
            'speedcurve_create_deployment' => [
                'class' => SpeedcurveCreateDeployment::class,
                'type' => 'write',
                'name' => 'Create Deployment',
                'description' => 'Register a new deployment to trigger synthetic tests.',
                'icon' => 'ph:rocket',
            ],
            'speedcurve_get_current_user' => [
                'class' => SpeedcurveGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get details about the authenticated SpeedCurve user.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/speedcurve.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.speedcurve.com/v1'],
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

            $service = new SpeedcurveService(
                apiKey: $creds->get('speedcurve', 'api_key', '', $account),
                baseUrl: $creds->get('speedcurve', 'url', 'https://api.speedcurve.com/v1', $account),
            );

            return new $class($service);
        }

        return new $class(app(SpeedcurveService::class));
    }
}
