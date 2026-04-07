<?php

namespace OpenCompany\Integrations\Airtable;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Airtable\Tools\AirtableListBases;
use OpenCompany\Integrations\Airtable\Tools\AirtableGetBase;
use OpenCompany\Integrations\Airtable\Tools\AirtableListRecords;
use OpenCompany\Integrations\Airtable\Tools\AirtableGetRecord;
use OpenCompany\Integrations\Airtable\Tools\AirtableCreateRecord;
use OpenCompany\Integrations\Airtable\Tools\AirtableListViews;
use OpenCompany\Integrations\Airtable\Tools\AirtableGetCurrentUser;

/**
 * Registers all Airtable tools and provides integration metadata.
 *
 * Exposes 7 tools covering bases, records, views, and user info
 * via the ToolProvider contract.
 */
class AirtableToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'airtable';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'bases, tables, records, views',
            'description' => 'Spreadsheets & Database',
            'icon' => 'ph:table',
            'logo' => 'simple-icons:airtable',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Airtable',
            'description' => 'Bases, tables, records, and views for the Airtable spreadsheet-database',
            'icon' => 'ph:table',
            'logo' => 'simple-icons:airtable',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://airtable.com/developers/web/api/introduction',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'pat...',
                'hint' => 'Airtable Personal Access Token or OAuth access token. Starts with <code>pat</code>.',
                'required' => true,
            ],
        ];
    }

    /**
     * Test the Airtable connection using the provided credentials.
     *
     * @param  array<string, mixed>  $config  Configuration containing 'access_token'
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided. Generate a Personal Access Token in your Airtable account settings.'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get('https://api.airtable.com/v0/whoami');

            $body = $response->json() ?? [];

            if ($response->failed()) {
                $error = $body['error']['message'] ?? $response->body();

                return [
                    'success' => false,
                    'error' => 'Airtable API error: ' . (is_string($error) ? $error : json_encode($error)),
                ];
            }

            $name = trim(($body['name'] ?? '') . ' ' . ($body['email'] ?? ''));

            return [
                'success' => true,
                'message' => "Connected to Airtable as {$name}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /** @return array<string, string> */
    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
        ];
    }

    public function tools(): array
    {
        return [
            'airtable_list_bases' => [
                'class' => AirtableListBases::class,
                'type' => 'read',
                'name' => 'List Bases',
                'description' => 'List all Airtable bases the token has access to.',
                'icon' => 'ph:database',
            ],
            'airtable_get_base' => [
                'class' => AirtableGetBase::class,
                'type' => 'read',
                'name' => 'Get Base',
                'description' => 'Get details for a single Airtable base by ID.',
                'icon' => 'ph:database',
            ],
            'airtable_list_records' => [
                'class' => AirtableListRecords::class,
                'type' => 'read',
                'name' => 'List Records',
                'description' => 'List records from an Airtable table with filtering, sorting, and pagination.',
                'icon' => 'ph:list',
            ],
            'airtable_get_record' => [
                'class' => AirtableGetRecord::class,
                'type' => 'read',
                'name' => 'Get Record',
                'description' => 'Get a single Airtable record by ID.',
                'icon' => 'ph:record',
            ],
            'airtable_create_record' => [
                'class' => AirtableCreateRecord::class,
                'type' => 'write',
                'name' => 'Create Record',
                'description' => 'Create a new record in an Airtable table.',
                'icon' => 'ph:plus-circle',
            ],
            'airtable_list_views' => [
                'class' => AirtableListViews::class,
                'type' => 'read',
                'name' => 'List Views',
                'description' => 'List views for an Airtable base.',
                'icon' => 'ph:eye',
            ],
            'airtable_get_current_user' => [
                'class' => AirtableGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated Airtable user profile.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/airtable.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
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
     * Resolve the AirtableService, with optional account-specific credentials.
     *
     * @param  array<string, mixed>  $context
     */
    private function resolveService(array $context = []): AirtableService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            return new AirtableService(
                accessToken: $creds->get('airtable', 'access_token', '', $account),
            );
        }

        return app(AirtableService::class);
    }
}
