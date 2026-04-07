<?php

namespace OpenCompany\Integrations\Terraform;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Terraform\Tools\TerraformListWorkspaces;
use OpenCompany\Integrations\Terraform\Tools\TerraformGetWorkspace;
use OpenCompany\Integrations\Terraform\Tools\TerraformListRuns;
use OpenCompany\Integrations\Terraform\Tools\TerraformGetRun;
use OpenCompany\Integrations\Terraform\Tools\TerraformListVariables;
use OpenCompany\Integrations\Terraform\Tools\TerraformListOrganizations;
use OpenCompany\Integrations\Terraform\Tools\TerraformGetCurrentUser;

/**
 * Tool provider for the Terraform Cloud integration.
 *
 * Registers 7 tools for interacting with Terraform Cloud:
 * workspaces, runs, variables, organizations, and user info.
 * Supports multi-account via resolveService().
 */
class TerraformToolProvider implements ToolProvider, ConfigurableIntegration
{
    /**
     * {@inheritDoc}
     */
    public function appName(): string
    {
        return 'terraform';
    }

    /**
     * {@inheritDoc}
     */
    public function appMeta(): array
    {
        return [
            'label' => 'workspaces, runs, variables, organizations',
            'description' => 'Infrastructure as code management',
            'icon' => 'ph:cloud',
            'logo' => 'simple-icons:terraform',
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Terraform Cloud',
            'description' => 'Managed Terraform infrastructure as code platform',
            'icon' => 'ph:cloud',
            'logo' => 'simple-icons:terraform',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://developer.hashicorp.com/terraform/cloud/api',
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_token',
                'type' => 'secret',
                'label' => 'API Token',
                'placeholder' => 'Enter your Terraform Cloud API token',
                'hint' => 'Generate a user or team API token in Terraform Cloud under Settings → API Tokens',
                'required' => true,
            ],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function testConnection(array $config): array
    {
        $apiToken = $config['api_token'] ?? '';

        if (empty($apiToken)) {
            return ['success' => false, 'error' => 'No API token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiToken,
                'Content-Type' => 'application/vnd.api+json',
            ])->timeout(10)->get('https://api.terraform.io/v2/account/details');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => 'Could not reach Terraform Cloud API. Check your connection.',
                ];
            }

            if (!$response->successful()) {
                $message = $json['errors'][0]['detail'] ?? $json['errors'][0]['title'] ?? "HTTP {$response->status()}";
                return [
                    'success' => false,
                    'error' => "Terraform Cloud API error: {$message}",
                ];
            }

            $userName = $json['data']['attributes']['username'] ?? 'Unknown';

            return [
                'success' => true,
                'message' => "Connected to Terraform Cloud as {$userName}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * {@inheritDoc}
     */
    public function validationRules(): array
    {
        return [
            'api_token' => 'nullable|string',
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function tools(): array
    {
        return [
            'terraform_list_workspaces' => [
                'class' => TerraformListWorkspaces::class,
                'type' => 'read',
                'name' => 'List Workspaces',
                'description' => 'List workspaces in a Terraform Cloud organization.',
                'icon' => 'ph:squares-four',
            ],
            'terraform_get_workspace' => [
                'class' => TerraformGetWorkspace::class,
                'type' => 'read',
                'name' => 'Get Workspace',
                'description' => 'Get details of a specific Terraform Cloud workspace.',
                'icon' => 'ph:squares-four',
            ],
            'terraform_list_runs' => [
                'class' => TerraformListRuns::class,
                'type' => 'read',
                'name' => 'List Runs',
                'description' => 'List runs for a Terraform Cloud workspace.',
                'icon' => 'ph:play',
            ],
            'terraform_get_run' => [
                'class' => TerraformGetRun::class,
                'type' => 'read',
                'name' => 'Get Run',
                'description' => 'Get details of a specific Terraform Cloud run.',
                'icon' => 'ph:play',
            ],
            'terraform_list_variables' => [
                'class' => TerraformListVariables::class,
                'type' => 'read',
                'name' => 'List Variables',
                'description' => 'List variables for a Terraform Cloud workspace.',
                'icon' => 'ph:brackets-curly',
            ],
            'terraform_list_organizations' => [
                'class' => TerraformListOrganizations::class,
                'type' => 'read',
                'name' => 'List Organizations',
                'description' => 'List Terraform Cloud organizations.',
                'icon' => 'ph:buildings',
            ],
            'terraform_get_current_user' => [
                'class' => TerraformGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated Terraform Cloud user.',
                'icon' => 'ph:user',
            ],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/terraform.md';
    }

    /**
     * {@inheritDoc}
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'api_token', 'type' => 'secret', 'label' => 'API Token', 'required' => true],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new TerraformService(
                apiToken: $creds->get('terraform', 'api_token', '', $account),
            );

            return new $class($service);
        }

        return new $class(app(TerraformService::class));
    }
}
