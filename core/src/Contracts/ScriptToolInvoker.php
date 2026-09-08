<?php

namespace OpenCompany\IntegrationCore\Contracts;

/**
 * Host-application adapter used by the shared Code Mode bridge.
 *
 * The bridge owns script-facing argument normalization and diagnostics, while
 * the host remains responsible for authorization, workspace isolation,
 * account resolution, tool construction, and external side effects.
 */
interface ScriptToolInvoker
{
    /**
     * Execute a tool by slug with script-facing named parameters.
     *
     * Implementations may normalize parameter names for legacy tool systems
     * before dispatching.
     *
     * @param  array<string, mixed>  $args
     * @param  string|null  $account  Account alias for multi-account integrations (null = default)
     */
    public function invoke(string $toolSlug, array $args, ?string $account = null): mixed;

    /**
     * Tool metadata for bridge call logging and UI decoration.
     *
     * @return array{icon?: string, name?: string, type?: string}
     */
    public function getToolMeta(string $toolSlug): array;
}
