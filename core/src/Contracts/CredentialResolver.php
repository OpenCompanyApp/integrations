<?php

namespace OpenCompany\IntegrationCore\Contracts;

interface CredentialResolver
{
    /**
     * Get a credential value for an integration.
     *
     * @param string       $integration  The integration ID (e.g., 'plausible', 'gmail')
     * @param string       $key          The config key (e.g., 'api_key', 'url')
     * @param mixed        $default      Default value if not found
     * @param string|null  $account      Account alias for multi-account support (e.g., 'work', 'personal').
     *                                   Null uses the default/only account.
     */
    public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed;

    /**
     * Check whether the integration has valid credentials configured.
     *
     * @param string|null  $account  Account alias. Null checks the default/only account.
     */
    public function isConfigured(string $integration, ?string $account = null): bool;
}
