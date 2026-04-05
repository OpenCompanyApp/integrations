<?php

namespace OpenCompany\IntegrationCore\Contracts;

/**
 * Simple key-value store scoped to a single trigger subscription.
 *
 * Implemented by the host application (database, Redis, file, etc.).
 * Triggers use this to persist webhook registration data and polling
 * cursors across invocations.
 */
interface TriggerStore
{
    /**
     * Retrieve a value by key.
     */
    public function get(string $key, mixed $default = null): mixed;

    /**
     * Store a value by key.
     */
    public function put(string $key, mixed $value): void;

    /**
     * Check if a key exists.
     */
    public function has(string $key): bool;

    /**
     * Remove a key.
     */
    public function forget(string $key): void;
}
