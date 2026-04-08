<?php

namespace OpenCompany\Integrations\Weave;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Weave\Tools\WeaveGetAppointment;
use OpenCompany\Integrations\Weave\Tools\WeaveGetCurrentUser;
use OpenCompany\Integrations\Weave\Tools\WeaveGetMessage;
use OpenCompany\Integrations\Weave\Tools\WeaveGetPatient;
use OpenCompany\Integrations\Weave\Tools\WeaveListAppointments;
use OpenCompany\Integrations\Weave\Tools\WeaveListMessages;
use OpenCompany\Integrations\Weave\Tools\WeaveListPatients;

class WeaveToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'weave';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'patients, appointments, messages',
            'description' => 'Healthcare communications',
            'icon' => 'ph:heartbeat',
            'logo' => 'simple-icons:weave',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Weave',
            'description' => 'Healthcare patient communication platform — manage patients, appointments, and messages.',
            'icon' => 'ph:heartbeat',
            'logo' => 'simple-icons:weave',
            'category' => 'healthcare',
            'badge' => 'verified',
            'docs_url' => 'https://developer.getweave.com',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Weave API access token',
                'hint' => 'Generate an access token in your Weave account under API settings',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.getweave.com',
                'hint' => 'Use <code>https://api.getweave.com</code> for production, or a custom URL for staging',
                'default' => 'https://api.getweave.com',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.getweave.com', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/api/v1/users/me');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Weave API at {$baseUrl}. Check the URL.",
                ];
            }

            $userName = $json['name'] ?? $json['email'] ?? 'unknown user';

            return [
                'success' => true,
                'message' => "Connected to Weave API as {$userName}.",
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
            'weave_list_patients' => [
                'class' => WeaveListPatients::class,
                'type' => 'read',
                'name' => 'List Patients',
                'description' => 'Search and list patients from the Weave platform.',
                'icon' => 'ph:users',
            ],
            'weave_get_patient' => [
                'class' => WeaveGetPatient::class,
                'type' => 'read',
                'name' => 'Get Patient',
                'description' => 'Retrieve a single patient by ID.',
                'icon' => 'ph:user',
            ],
            'weave_list_appointments' => [
                'class' => WeaveListAppointments::class,
                'type' => 'read',
                'name' => 'List Appointments',
                'description' => 'List appointments with optional date range filtering.',
                'icon' => 'ph:calendar',
            ],
            'weave_get_appointment' => [
                'class' => WeaveGetAppointment::class,
                'type' => 'read',
                'name' => 'Get Appointment',
                'description' => 'Retrieve a single appointment by ID.',
                'icon' => 'ph:calendar-dots',
            ],
            'weave_list_messages' => [
                'class' => WeaveListMessages::class,
                'type' => 'read',
                'name' => 'List Messages',
                'description' => 'List patient messages with optional type filtering.',
                'icon' => 'ph:chat-circle-text',
            ],
            'weave_get_message' => [
                'class' => WeaveGetMessage::class,
                'type' => 'read',
                'name' => 'Get Message',
                'description' => 'Retrieve a single message by ID.',
                'icon' => 'ph:chat-circle',
            ],
            'weave_get_current_user' => [
                'class' => WeaveGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated Weave user profile.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/weave.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'Weave API URL', 'required' => false, 'default' => 'https://api.getweave.com'],
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

            $service = new WeaveService(
                accessToken: $creds->get('weave', 'access_token', '', $account),
                baseUrl: $creds->get('weave', 'url', 'https://api.getweave.com', $account),
            );

            return new $class($service);
        }

        return new $class(app(WeaveService::class));
    }
}
