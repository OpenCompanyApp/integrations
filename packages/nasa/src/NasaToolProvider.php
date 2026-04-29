<?php

namespace OpenCompany\Integrations\Nasa;

use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Nasa\Tools\NasaGetApod;
use OpenCompany\Integrations\Nasa\Tools\NasaGetAsteroid;
use OpenCompany\Integrations\Nasa\Tools\NasaGetAsteroids;
use OpenCompany\Integrations\Nasa\Tools\NasaGetCurrentUser;
use OpenCompany\Integrations\Nasa\Tools\NasaGetMarsRoverPhotos;
use OpenCompany\Integrations\Nasa\Tools\NasaSearchImages;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class NasaToolProvider implements ToolProvider, HasIntegrationCapabilities
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
            'strategy' => 'api_key',
            'legacy_auth_type' => 'api_key',
            'credential_mode' => 'secret',
            'setup_flows' =>
            [
              0 => 'manual_secret',
            ],
            'requires_browser_for_setup' => false,
            'refreshable' => false,
            'token_keys' =>
            [
            ],
            'notes' =>
            [
            ],
          ],
          'host_availability' => [
            'web' =>
            [
              'setup_supported' => true,
              'runtime_supported' => true,
              'setup_mode' => 'manual_secret',
            ],
            'cli' =>
            [
              'setup_supported' => true,
              'runtime_supported' => true,
              'setup_mode' => 'manual_secret',
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



/**
     * Get the application name used for registration.
     */
    public function appName(): string
    {
        return 'nasa';
    }

    /**
     * Metadata shown in app and catalog discovery UIs.
     *
     * @return array<string, mixed>
     */
    public function appMeta(): array
    {
        return [
            'label' => 'NASA',
            'description' => 'NASA space and science data',
            'icon' => 'ph:rocket',
            'logo' => 'simple-icons:nasa',
        ];
    }

    /**
     * Canonical integration metadata used by settings and generated catalogs.
     *
     * @return array<string, mixed>
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'NASA',
            'description' => 'NASA space and science data',
            'icon' => 'ph:rocket',
            'logo' => 'simple-icons:nasa',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://api.nasa.gov/',
        ];
    }
    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => false, 'placeholder' => 'DEMO_KEY'],
            ['key' => 'url', 'type' => 'url', 'label' => 'Base URL', 'required' => false, 'default' => 'https://api.nasa.gov'],
        ];
    }

    /**
     * Create a tool instance.
     *
     * @param  class-string<Tool>  $class  The tool class to instantiate.
     * @param  array<string, mixed>  $context  Optional context (unused for public API).
     * @return Tool The instantiated tool.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            $service = new NasaService(
                apiKey: $creds->get('nasa', 'api_key', 'DEMO_KEY', $account),
                baseUrl: $creds->get('nasa', 'url', 'https://api.nasa.gov', $account),
            );

            return new $class($service);
        }

        return new $class(app(NasaService::class));
    }
}
