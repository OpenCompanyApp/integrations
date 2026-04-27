<?php

namespace OpenCompany\Integrations\Recaptcha;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Recaptcha\Tools\ListAssessments;
use OpenCompany\Integrations\Recaptcha\Tools\GetAssessment;
use OpenCompany\Integrations\Recaptcha\Tools\CreateAssessment;
use OpenCompany\Integrations\Recaptcha\Tools\ListKeys;
use OpenCompany\Integrations\Recaptcha\Tools\GetKey;
use OpenCompany\Integrations\Recaptcha\Tools\ListAnnotations;
use OpenCompany\Integrations\Recaptcha\Tools\GetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class RecaptchaToolProvider implements ToolProvider, HasIntegrationCapabilities
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
            'setup_flows' =>
            [
              0 => 'none',
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
              'setup_mode' => 'none',
            ],
            'cli' =>
            [
              'setup_supported' => true,
              'runtime_supported' => true,
              'setup_mode' => 'none',
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
        return 'recaptcha';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'captcha, verification, bot detection, security',
            'description' => 'Google reCAPTCHA Enterprise verification',
            'icon' => 'ph:shield-check',
            'logo' => 'logos:google-recaptcha',
        ];
    }

    public function tools(): array
    {
        return [
            'recaptcha_list_assessments' => [
                'class' => ListAssessments::class,
                'type' => 'read',
                'name' => 'List Assessments',
                'description' => 'List reCAPTCHA Enterprise assessments for a project.',
                'icon' => 'ph:list',
            ],
            'recaptcha_get_assessment' => [
                'class' => GetAssessment::class,
                'type' => 'read',
                'name' => 'Get Assessment',
                'description' => 'Get a single reCAPTCHA Enterprise assessment by name.',
                'icon' => 'ph:magnifying-glass',
            ],
            'recaptcha_create_assessment' => [
                'class' => CreateAssessment::class,
                'type' => 'write',
                'name' => 'Create Assessment',
                'description' => 'Create a reCAPTCHA Enterprise assessment to evaluate a token.',
                'icon' => 'ph:plus',
            ],
            'recaptcha_list_keys' => [
                'class' => ListKeys::class,
                'type' => 'read',
                'name' => 'List Keys',
                'description' => 'List reCAPTCHA Enterprise site keys for a project.',
                'icon' => 'ph:key',
            ],
            'recaptcha_get_key' => [
                'class' => GetKey::class,
                'type' => 'read',
                'name' => 'Get Key',
                'description' => 'Get a reCAPTCHA Enterprise site key by name.',
                'icon' => 'ph:key',
            ],
            'recaptcha_list_annotations' => [
                'class' => ListAnnotations::class,
                'type' => 'read',
                'name' => 'List Annotations',
                'description' => 'List annotations for a reCAPTCHA Enterprise assessment.',
                'icon' => 'ph:note',
            ],
            'recaptcha_get_current_user' => [
                'class' => GetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get info about the current API access and service status.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    public function createTool(string $class, array $context = []): Tool
    {
        return new $class(app(RecaptchaService::class));
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/recaptcha.md';
    }    public function credentialFields(): array
    {
        return [];
    }
}
