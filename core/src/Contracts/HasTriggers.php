<?php

namespace OpenCompany\IntegrationCore\Contracts;

/**
 * Optional interface for ToolProviders that also provide triggers.
 *
 * Follows the same pattern as ConfigurableIntegration — only implemented
 * by providers that actually have triggers. The host checks
 * `$provider instanceof HasTriggers` before querying triggers.
 */
interface HasTriggers
{
    /**
     * Trigger definitions with metadata.
     *
     * Returns slug => metadata array:
     *   'class'       => string  (FQCN of the Trigger class)
     *   'name'        => string  (human-readable display name)
     *   'description' => string  (short description for listings)
     *   'icon'        => string  (Iconify icon identifier)
     *
     * @return array<string, array{class: string, name: string, description: string, icon: string}>
     */
    public function triggers(): array;

    /**
     * Create a trigger instance.
     *
     * Same pattern as createTool() — $context carries runtime deps from the host.
     */
    public function createTrigger(string $class, array $context = []): Trigger;
}
