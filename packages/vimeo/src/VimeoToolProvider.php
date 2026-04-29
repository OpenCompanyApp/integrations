<?php

namespace OpenCompany\Integrations\Vimeo;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Vimeo\Tools\VimeoCreateVideo;
use OpenCompany\Integrations\Vimeo\Tools\VimeoGetCurrentUser;
use OpenCompany\Integrations\Vimeo\Tools\VimeoGetVideo;
use OpenCompany\Integrations\Vimeo\Tools\VimeoListAlbums;
use OpenCompany\Integrations\Vimeo\Tools\VimeoListFolders;
use OpenCompany\Integrations\Vimeo\Tools\VimeoListVideos;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;

/**
 * Registers the integration provider and exposes its tools.
 */
class VimeoToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
            'strategy' => 'bearer_token',
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
        return 'vimeo';
    }

public function appMeta(): array
    {
        return [
            'label' => 'Vimeo',
            'description' => 'Video hosting',
            'icon' => 'ph:video-camera',
            'logo' => 'simple-icons:vimeo',
        ];
    }

public function integrationMeta(): array
    {
        return [
            'name' => 'Vimeo',
            'description' => 'Video hosting, albums, and folder management',
            'icon' => 'ph:video-camera',
            'logo' => 'simple-icons:vimeo',
            'category' => 'media',
            'badge' => 'verified',
            'docs_url' => 'https://developer.vimeo.com/api/reference',
        ];
    }public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'base_url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.vimeo.com'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance with optional multi-account credential resolution.
     *
     * @param  class-string<Tool>  $class  The tool class to instantiate
     * @param  array<string, mixed>  $context  Runtime context, may contain 'account' for multi-account
     */
    public function createTool(string $class, array $context = []): Tool
    {        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the VimeoService, with optional account-specific credentials.
     *
     * When $context['account'] is set, creates a fresh service with that
     * account's credentials. Otherwise uses the container singleton.
     *
     * @param  array<string, mixed>  $context  Runtime context
     */
    private function resolveService(array $context = []): VimeoService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            return new VimeoService(
                accessToken: $creds->get('vimeo', 'access_token', '', $account),
                baseUrl: $creds->get('vimeo', 'base_url', 'https://api.vimeo.com', $account),
            );
        }

        return app(VimeoService::class);
    }
}
