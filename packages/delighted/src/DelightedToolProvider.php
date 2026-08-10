<?php

namespace OpenCompany\Integrations\Delighted;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Tool catalog and configuration metadata for Delighted.
 *
 * Exposes Delighted survey, metrics, people, unsubscribe, bounce, and Autopilot
 * membership endpoints for customer-experience workflows.
 */
class DelightedToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    private const TOOL_DEFINITIONS = [
        'delighted_send_person' => ['DelightedSendPerson', 'write', 'Send Person Survey', 'Create or update a person and schedule a survey.', 'ph:paper-plane-tilt'],
        'delighted_list_survey_responses' => ['DelightedListSurveyResponses', 'read', 'List Survey Responses', 'List survey responses.', 'ph:list-checks'],
        'delighted_get_metrics' => ['DelightedGetMetrics', 'read', 'Get Metrics', 'Get account metrics and score breakdowns.', 'ph:chart-line'],
        'delighted_create_survey_response' => ['DelightedCreateSurveyResponse', 'write', 'Create Survey Response', 'Add a survey response manually.', 'ph:plus-circle'],
        'delighted_delete_pending_survey_request' => ['DelightedDeletePendingSurveyRequest', 'write', 'Delete Pending Survey Request', 'Delete pending survey requests for a person.', 'ph:clock-counter-clockwise'],
        'delighted_unsubscribe_person' => ['DelightedUnsubscribePerson', 'write', 'Unsubscribe Person', 'Unsubscribe a person.', 'ph:bell-slash'],
        'delighted_list_people' => ['DelightedListPeople', 'read', 'List People', 'List people.', 'ph:user-list'],
        'delighted_list_unsubscribes' => ['DelightedListUnsubscribes', 'read', 'List Unsubscribes', 'List unsubscribed people.', 'ph:user-minus'],
        'delighted_list_bounces' => ['DelightedListBounces', 'read', 'List Bounces', 'List bounced people.', 'ph:warning-circle'],
        'delighted_delete_person' => ['DelightedDeletePerson', 'write', 'Delete Person', 'Delete a person by identifier.', 'ph:trash'],
        'delighted_get_autopilot_email' => ['DelightedGetAutopilotEmail', 'read', 'Get Email Autopilot', 'Get email Autopilot configuration.', 'ph:envelope'],
        'delighted_get_autopilot_sms' => ['DelightedGetAutopilotSms', 'read', 'Get SMS Autopilot', 'Get SMS Autopilot configuration.', 'ph:chat-circle'],
        'delighted_list_autopilot_email_memberships' => ['DelightedListAutopilotEmailMemberships', 'read', 'List Email Autopilot Memberships', 'List people in email Autopilot.', 'ph:users'],
        'delighted_list_autopilot_sms_memberships' => ['DelightedListAutopilotSmsMemberships', 'read', 'List SMS Autopilot Memberships', 'List people in SMS Autopilot.', 'ph:users-three'],
        'delighted_add_autopilot_email_membership' => ['DelightedAddAutopilotEmailMembership', 'write', 'Add Email Autopilot Membership', 'Add a person to email Autopilot.', 'ph:user-plus'],
        'delighted_add_autopilot_sms_membership' => ['DelightedAddAutopilotSmsMembership', 'write', 'Add SMS Autopilot Membership', 'Add a person to SMS Autopilot.', 'ph:user-plus'],
        'delighted_remove_autopilot_email_membership' => ['DelightedRemoveAutopilotEmailMembership', 'write', 'Remove Email Autopilot Membership', 'Remove a person from email Autopilot.', 'ph:user-minus'],
        'delighted_remove_autopilot_sms_membership' => ['DelightedRemoveAutopilotSmsMembership', 'write', 'Remove SMS Autopilot Membership', 'Remove a person from SMS Autopilot.', 'ph:user-minus'],
        'delighted_api_get' => ['DelightedApiGet', 'read', 'API GET', 'Call a safe relative Delighted GET path.', 'ph:code'],
        'delighted_api_post' => ['DelightedApiPost', 'write', 'API POST', 'Call a safe relative Delighted POST path.', 'ph:code'],
        'delighted_api_delete' => ['DelightedApiDelete', 'write', 'API DELETE', 'Call a safe relative Delighted DELETE path.', 'ph:code'],
    ];

    /**
     * Describe authentication and host capabilities.
     *
     * @return array<string, mixed>
     */
    public function integrationCapabilities(): array
    {
        return [
            'auth' => [
                'strategy' => 'basic_auth',
                'legacy_auth_type' => 'api_key',
                'credential_mode' => 'required_secret',
                'setup_flows' => ['manual_secret'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => ['api_key'],
                'notes' => ['Delighted uses Basic authentication with the API key as username and an empty password.'],
            ],
            'host_availability' => [
                'web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret'],
                'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret', 'runtime_mode' => 'normal'],
            ],
            'runtime_requirements' => [],
            'compatibility' => ['web_setup_supported' => true, 'web_runtime_supported' => true, 'cli_setup_supported' => true, 'cli_runtime_supported' => true],
        ];
    }

    public function appName(): string { return 'delighted'; }

    public function appMeta(): array
    {
        return ['label' => 'Delighted', 'description' => 'Customer survey sends, responses, metrics, people, and Autopilot', 'icon' => 'ph:smiley', 'logo' => 'ph:smiley'];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Delighted',
            'description' => 'Manage Delighted surveys, responses, metrics, people, unsubscribes, bounces, and Autopilot memberships.',
            'icon' => 'ph:smiley',
            'logo' => 'ph:smiley',
            'category' => 'analytics',
            'badge' => 'verified',
            'docs_url' => 'https://app.delighted.com/docs/api',
        ];
    }

    public function configSchema(): array { return $this->credentialFields(); }

    /**
     * Verify Delighted credentials with the metrics endpoint.
     *
     * @param  array<string, mixed>  $config  Credential settings.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        try {
            $apiKey = (string) ($config['api_key'] ?? '');
            if ($apiKey === '') {
                return ['success' => false, 'error' => 'Delighted API key is required.'];
            }

            $baseUrl = rtrim((string) ($config['url'] ?? ''), '/') ?: 'https://api.delighted.com';
            $response = Http::withHeaders(['Accept' => 'application/json'])
                ->withBasicAuth($apiKey, '')
                ->timeout(20)
                ->get($baseUrl.'/v1/metrics.json');

            if (!$response->successful()) {
                return ['success' => false, 'error' => 'Delighted API returned HTTP '.$response->status().'.'];
            }

            return ['success' => true, 'message' => 'Connected to Delighted API.'];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return ['api_key' => 'required|string', 'url' => 'nullable|string'];
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'placeholder' => 'Delighted private API key', 'hint' => 'Private API key for the selected Delighted CX project.', 'required' => true],
            ['key' => 'url', 'type' => 'text', 'label' => 'API URL', 'placeholder' => 'https://api.delighted.com', 'hint' => 'Optional Delighted base URL override.', 'required' => false],
        ];
    }

    public function tools(): array
    {
        $tools = [];
        foreach (self::TOOL_DEFINITIONS as $slug => [$class, $type, $name, $description, $icon]) {
            $tools[$slug] = ['class' => __NAMESPACE__.'\\Tools\\'.$class, 'type' => $type, 'name' => $name, 'description' => $description, 'icon' => $icon];
        }

        return $tools;
    }

    public function isIntegration(): bool { return true; }

    /**
     * Create a Delighted tool instance.
     *
     * @param  array<string, mixed>  $context  Optional account context.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve a service for the default or named account.
     *
     * @param  array<string, mixed>  $context  Tool creation context.
     */
    private function resolveService(array $context = []): DelightedService
    {
        $account = $context['account'] ?? null;
        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new DelightedService(
                apiKey: $creds->get('delighted', 'api_key', '', $account),
                baseUrl: $creds->get('delighted', 'url', 'https://api.delighted.com', $account),
            );
        }

        return app(DelightedService::class);
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__.'/../script-docs/delighted.md';
    }
}
