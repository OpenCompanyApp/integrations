<?php

namespace OpenCompany\Integrations\Netlify;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Netlify\Tools\NetlifyListSites;
use OpenCompany\Integrations\Netlify\Tools\NetlifyGetSite;
use OpenCompany\Integrations\Netlify\Tools\NetlifyCreateSite;
use OpenCompany\Integrations\Netlify\Tools\NetlifyDeleteSite;
use OpenCompany\Integrations\Netlify\Tools\NetlifyListDeploys;
use OpenCompany\Integrations\Netlify\Tools\NetlifyCreateDeploy;
use OpenCompany\Integrations\Netlify\Tools\NetlifyListForms;
use OpenCompany\Integrations\Netlify\Tools\NetlifyGetForm;
use OpenCompany\Integrations\Netlify\Tools\NetlifyGetCurrentUser;

class NetlifyToolProvider implements ToolProvider, ConfigurableIntegration
{
    /**
     * Get the application name used for registration.
     */
    public function appName(): string
    {
        return 'netlify';
    }

    /**
     * Get metadata for the application sidebar / UI.
     *
     * @return array<string, mixed>
     */
    public function appMeta(): array
    {
        return [
            'label' => 'sites, deploys, forms',
            'description' => 'Web hosting & deploys',
            'icon' => 'ph:cloud-arrow-up',
            'logo' => 'simple-icons:netlify',
        ];
    }

    /**
     * Get integration metadata for the marketplace / integrations UI.
     *
     * @return array<string, mixed>
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Netlify',
            'description' => 'Web hosting, continuous deployment, and serverless functions',
            'icon' => 'ph:cloud-arrow-up',
            'logo' => 'simple-icons:netlify',
            'category' => 'hosting',
            'badge' => 'verified',
            'docs_url' => 'https://open-api.netlify.com/',
        ];
    }

    /**
     * Get the configuration schema for this integration.
     *
     * @return array<int, array<string, mixed>>
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Netlify personal access token',
                'hint' => 'Generate a personal access token in Netlify under <strong>User Settings → Applications → Personal access tokens</strong>',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.netlify.com/api/v1',
                'hint' => 'The Netlify API base URL. Change only if using a proxy or custom endpoint.',
                'default' => 'https://api.netlify.com/api/v1',
            ],
        ];
    }

    /**
     * Test the connection using the provided configuration.
     *
     * @param  array<string, mixed>  $config
     * @return array<string, mixed>
     */
    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.netlify.com/api/v1', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/user');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Netlify API at {$baseUrl}. Check the URL.",
                ];
            }

            if (!$response->successful()) {
                $error = $json['message'] ?? $response->body();

                return [
                    'success' => false,
                    'error' => is_string($error) ? $error : json_encode($error),
                ];
            }

            $email = $json['email'] ?? 'unknown';

            return [
                'success' => true,
                'message' => "Connected to Netlify API as {$email}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Get validation rules for the configuration.
     *
     * @return array<string, mixed>
     */
    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    /**
     * Get the available tools provided by this integration.
     *
     * @return array<string, array<string, mixed>>
     */
    public function tools(): array
    {
        return [
            'netlify_list_sites' => [
                'class' => NetlifyListSites::class,
                'type' => 'read',
                'name' => 'List Sites',
                'description' => 'List all Netlify sites.',
                'icon' => 'ph:globe',
            ],
            'netlify_get_site' => [
                'class' => NetlifyGetSite::class,
                'type' => 'read',
                'name' => 'Get Site',
                'description' => 'Get details for a specific Netlify site.',
                'icon' => 'ph:globe',
            ],
            'netlify_create_site' => [
                'class' => NetlifyCreateSite::class,
                'type' => 'write',
                'name' => 'Create Site',
                'description' => 'Create a new Netlify site.',
                'icon' => 'ph:plus-circle',
            ],
            'netlify_delete_site' => [
                'class' => NetlifyDeleteSite::class,
                'type' => 'write',
                'name' => 'Delete Site',
                'description' => 'Delete a Netlify site permanently.',
                'icon' => 'ph:trash',
            ],
            'netlify_list_deploys' => [
                'class' => NetlifyListDeploys::class,
                'type' => 'read',
                'name' => 'List Deploys',
                'description' => 'List deploys for a Netlify site.',
                'icon' => 'ph:rocket-launch',
            ],
            'netlify_create_deploy' => [
                'class' => NetlifyCreateDeploy::class,
                'type' => 'write',
                'name' => 'Create Deploy',
                'description' => 'Trigger a new deploy for a Netlify site.',
                'icon' => 'ph:rocket-launch',
            ],
            'netlify_list_forms' => [
                'class' => NetlifyListForms::class,
                'type' => 'read',
                'name' => 'List Forms',
                'description' => 'List forms for a Netlify site.',
                'icon' => 'ph:form',
            ],
            'netlify_get_form' => [
                'class' => NetlifyGetForm::class,
                'type' => 'read',
                'name' => 'Get Form',
                'description' => 'Get details for a specific Netlify form.',
                'icon' => 'ph:form',
            ],
            'netlify_get_current_user' => [
                'class' => NetlifyGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated Netlify user.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    /**
     * Get the path to the Lua docs file for this integration.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/netlify.md';
    }

    /**
     * Get the credential fields for this integration.
     *
     * @return array<int, array<string, mixed>>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.netlify.com/api/v1'],
        ];
    }

    /**
     * Indicate this is a full integration.
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance, optionally using account-specific credentials.
     *
     * @param  class-string<Tool>  $class
     * @param  array<string, mixed>  $context
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new NetlifyService(
                accessToken: $creds->get('netlify', 'access_token', '', $account),
                baseUrl: $creds->get('netlify', 'url', 'https://api.netlify.com/api/v1', $account),
            );

            return new $class($service);
        }

        return new $class(app(NetlifyService::class));
    }
}
