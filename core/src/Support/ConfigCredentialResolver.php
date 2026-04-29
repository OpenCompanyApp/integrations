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
        $config = $account !== null
            ? config("ai-tools.{$integration}.{$account}", [])
            : config("ai-tools.{$integration}", []);

        if (! is_array($config)) {
            return false;
        }

        foreach (['api_key', 'api_token', 'access_token', 'refresh_token', 'token', 'bearer_token', 'client_secret', 'password'] as $key) {
            if (! empty($config[$key])) {
                return true;
            }
        }

        return false;
    }

    public function getAccounts(string $integration): array
    {
        $config = config("ai-tools.{$integration}", []);

        if (! is_array($config)) {
            return [];
        }

        // Account keys are sub-arrays (e.g., 'work' => ['api_key' => '...'])
        // Flat keys like 'api_key' => '...' are the default account, not aliases
        return array_values(array_filter(
            array_keys($config),
            fn (string $key) => is_array($config[$key]),
        ));
    }
}
