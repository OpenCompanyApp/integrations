<?php

namespace OpenCompany\Integrations\Ahrefs\Tools;

/**
 * Get Ahrefs API subscription limits and usage.
 */
class AhrefsGetLimitsAndUsage extends AbstractAhrefsTool
{
    public function name(): string
    {
        return 'ahrefs_get_limits_and_usage';
    }

    public function description(): string
    {
        return 'Get Ahrefs API subscription limits and usage for the authenticated API key.';
    }

    public function parameters(): array
    {
        return [];
    }

    /** @param  array<string, mixed>  $args  Tool arguments. */
    protected function callService(array $args): array
    {
        return $this->service->getLimitsAndUsage();
    }
}
