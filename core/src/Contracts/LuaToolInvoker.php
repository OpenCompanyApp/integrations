<?php

namespace OpenCompany\IntegrationCore\Contracts;

/**
 * Host-application adapter used by the shared Lua bridge.
 *
 * The bridge resolves app.* paths to tool slugs, then delegates actual
 * instantiation and execution to the host via this interface.
 */
interface LuaToolInvoker
{
    /**
     * Execute a tool by slug with Lua-facing named parameters.
     *
     * Implementations may normalize parameter names for legacy tool systems
     * before dispatching.
     *
     * @param  array<string, mixed>  $args
     */
    public function invoke(string $toolSlug, array $args): mixed;

    /**
     * Tool metadata for bridge call logging and UI decoration.
     *
     * @return array{icon?: string, name?: string}
     */
    public function getToolMeta(string $toolSlug): array;
}
