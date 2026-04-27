<?php

namespace OpenCompany\Integrations\SurveyMonkey;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\SurveyMonkey\Tools\SurveyMonkeyListSurveys;
use OpenCompany\Integrations\SurveyMonkey\Tools\SurveyMonkeyGetSurvey;
use OpenCompany\Integrations\SurveyMonkey\Tools\SurveyMonkeyCreateSurvey;
use OpenCompany\Integrations\SurveyMonkey\Tools\SurveyMonkeyListResponses;
use OpenCompany\Integrations\SurveyMonkey\Tools\SurveyMonkeyGetResponse;
use OpenCompany\Integrations\SurveyMonkey\Tools\SurveyMonkeyListCollectors;
use OpenCompany\Integrations\SurveyMonkey\Tools\SurveyMonkeyCreateCollector;
use OpenCompany\Integrations\SurveyMonkey\Tools\SurveyMonkeyGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class SurveyMonkeyToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{

/**
     * Describe host and authentication capabilities for catalog and setup flows.
     *
     * @return array<string, mixed>
     */
    public function integrationCapabilities(): array
    {
        return [
          'auth' => [
            'strategy' => 'oauth2_manual_token',
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
              0 => 'Token acquisition may happen outside this package, but the host only needs to store the resulting token.',
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
        return 'surveymonkey';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'surveys, responses, collectors',
            'description' => 'Survey management',
            'icon' => 'ph:clipboard-text',
            'logo' => 'simple-icons:surveymonkey',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'SurveyMonkey',
            'description' => 'Create and manage surveys, collect responses, and manage survey collectors.',
            'icon' => 'ph:clipboard-text',
            'logo' => 'simple-icons:surveymonkey',
            'category' => 'surveys',
            'badge' => 'verified',
            'docs_url' => 'https://developer.surveymonkey.com/api/v3/',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your SurveyMonkey access token',
                'hint' => 'Generate an access token in your SurveyMonkey developer account under "My Apps". Use the full OAuth access token.',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.surveymonkey.com/v3',
                'hint' => 'Use <code>https://api.surveymonkey.com/v3</code> for the US region, or <code>https://api.eu.surveymonkey.com/v3</code> for the EU region.',
                'default' => 'https://api.surveymonkey.com/v3',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.surveymonkey.com/v3', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/users/me');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach SurveyMonkey API at {$baseUrl}. Check the URL.",
                ];
            }

            if (!$response->successful()) {
                $error = $json['error']['message'] ?? $json['message'] ?? 'Unknown error';
                return [
                    'success' => false,
                    'error' => "SurveyMonkey API error: {$error}",
                ];
            }

            $username = $json['first_name'] ?? $json['username'] ?? 'User';

            return [
                'success' => true,
                'message' => "Connected to SurveyMonkey API as {$username}.",
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
            'surveymonkey_list_surveys' => [
                'class' => SurveyMonkeyListSurveys::class,
                'type' => 'read',
                'name' => 'List Surveys',
                'description' => 'List all surveys in your SurveyMonkey account.',
                'icon' => 'ph:list',
            ],
            'surveymonkey_get_survey' => [
                'class' => SurveyMonkeyGetSurvey::class,
                'type' => 'read',
                'name' => 'Get Survey',
                'description' => 'Get details of a specific survey by ID.',
                'icon' => 'ph:clipboard-text',
            ],
            'surveymonkey_create_survey' => [
                'class' => SurveyMonkeyCreateSurvey::class,
                'type' => 'write',
                'name' => 'Create Survey',
                'description' => 'Create a new survey with a title.',
                'icon' => 'ph:plus-circle',
            ],
            'surveymonkey_list_responses' => [
                'class' => SurveyMonkeyListResponses::class,
                'type' => 'read',
                'name' => 'List Responses',
                'description' => 'List all bulk responses for a survey.',
                'icon' => 'ph:chat-dots',
            ],
            'surveymonkey_get_response' => [
                'class' => SurveyMonkeyGetResponse::class,
                'type' => 'read',
                'name' => 'Get Response',
                'description' => 'Get a single response for a survey.',
                'icon' => 'ph:chat-dots',
            ],
            'surveymonkey_list_collectors' => [
                'class' => SurveyMonkeyListCollectors::class,
                'type' => 'read',
                'name' => 'List Collectors',
                'description' => 'List all collectors for a survey.',
                'icon' => 'ph:link',
            ],
            'surveymonkey_create_collector' => [
                'class' => SurveyMonkeyCreateCollector::class,
                'type' => 'write',
                'name' => 'Create Collector',
                'description' => 'Create a collector for distributing a survey.',
                'icon' => 'ph:link-plus',
            ],
            'surveymonkey_get_current_user' => [
                'class' => SurveyMonkeyGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get details of the currently authenticated SurveyMonkey user.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/surveymonkey.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.surveymonkey.com/v3'],
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

            $service = new SurveyMonkeyService(
                accessToken: $creds->get('surveymonkey', 'access_token', '', $account),
                baseUrl: $creds->get('surveymonkey', 'url', 'https://api.surveymonkey.com/v3', $account),
            );

            return new $class($service);
        }

        return new $class(app(SurveyMonkeyService::class));
    }
}
