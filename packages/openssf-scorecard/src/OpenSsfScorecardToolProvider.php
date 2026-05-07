<?php

namespace OpenCompany\Integrations\OpenSsfScorecard;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\OpenSsfScorecard\Tools\OpenSsfScorecardBadge;
use OpenCompany\Integrations\OpenSsfScorecard\Tools\OpenSsfScorecardCheck;
use OpenCompany\Integrations\OpenSsfScorecard\Tools\OpenSsfScorecardResult;
use OpenCompany\Integrations\OpenSsfScorecard\Tools\OpenSsfScorecardViewerUrl;

/**
 * Tool catalog and metadata for OpenSSF Scorecard.
 *
 * Exposes the published Scorecard REST API result and badge endpoints plus
 * agent-friendly helpers for individual checks and viewer URLs.
 */
class OpenSsfScorecardToolProvider implements ToolProvider, HasIntegrationCapabilities
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
                'strategy' => 'none',
                'legacy_auth_type' => 'none',
                'credential_mode' => 'none',
                'setup_flows' => ['none'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => [],
                'notes' => ['The published OpenSSF Scorecard API is public and requires no API key.'],
            ],
            'host_availability' => [
                'web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'none'],
                'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'none', 'runtime_mode' => 'normal'],
            ],
            'runtime_requirements' => [],
            'compatibility' => ['web_setup_supported' => true, 'web_runtime_supported' => true, 'cli_setup_supported' => true, 'cli_runtime_supported' => true],
        ];
    }

    public function appName(): string
    {
        return 'openssf-scorecard';
    }

    /**
     * Metadata shown in app and catalog discovery UIs.
     *
     * @return array<string, mixed>
     */
    public function appMeta(): array
    {
        return [
            'label' => 'OpenSSF Scorecard',
            'description' => 'Published OpenSSF Scorecard results, checks, badges, and viewer URLs',
            'icon' => 'ph:shield-star',
            'logo' => 'ph:shield-star',
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
            'name' => 'OpenSSF Scorecard',
            'description' => 'OpenSSF Scorecard API for published open source project security score results, individual check lookup, score badges, and viewer URLs.',
            'icon' => 'ph:shield-star',
            'logo' => 'ph:shield-star',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://github.com/ossf/scorecard-webapp',
        ];
    }

    public function credentialFields(): array
    {
        return [];
    }

    public function tools(): array
    {
        return [
            'openssf_scorecard_result' => ['class' => OpenSsfScorecardResult::class, 'type' => 'read', 'name' => 'Result', 'description' => 'Retrieve a published repository Scorecard result.', 'icon' => 'ph:shield-check'],
            'openssf_scorecard_check' => ['class' => OpenSsfScorecardCheck::class, 'type' => 'read', 'name' => 'Check', 'description' => 'Retrieve one check from a published Scorecard result.', 'icon' => 'ph:list-checks'],
            'openssf_scorecard_badge' => ['class' => OpenSsfScorecardBadge::class, 'type' => 'read', 'name' => 'Badge', 'description' => 'Retrieve the OpenSSF Scorecard badge SVG.', 'icon' => 'ph:image'],
            'openssf_scorecard_viewer_url' => ['class' => OpenSsfScorecardViewerUrl::class, 'type' => 'read', 'name' => 'Viewer URL', 'description' => 'Build the public Scorecard viewer URL for a repository.', 'icon' => 'ph:link'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create an OpenSSF Scorecard tool from the catalog class name.
     *
     * @param  array<string, mixed>  $context  Optional tool context.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class(app(OpenSsfScorecardService::class));
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__.'/../lua-docs/openssf-scorecard.md';
    }
}
