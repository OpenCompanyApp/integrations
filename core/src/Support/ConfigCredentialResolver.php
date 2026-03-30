<?php

namespace OpenCompany\IntegrationCore\Support;

use OpenCompany\IntegrationCore\Contracts\CredentialResolver;

/**
 * Default credential resolver that reads from Laravel config.
 *
 * Config structure without accounts: config/ai-tools.php
 *   'plausible' => ['api_key' => env('PLAUSIBLE_API_KEY'), 'url' => '...']
 *
 * Config structure with accounts: config/ai-tools.php
 *   'gmail' => ['work' => ['api_key' => '...'], 'personal' => ['api_key' => '...']]
 */
class ConfigCredentialResolver implements CredentialResolver
{
    public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
    {
        if ($account !== null) {
            return config("ai-tools.{$integration}.{$account}.{$key}", $default);
        }

        return config("ai-tools.{$integration}.{$key}", $default);
    }

    public function isConfigured(string $integration, ?string $account = null): bool
    {
        return ! empty($this->get($integration, 'api_key', null, $account));
    }
}
