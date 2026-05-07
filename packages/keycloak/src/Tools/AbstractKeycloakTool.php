<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Keycloak\KeycloakService;

/**
 * Shared executor for Keycloak endpoint-specific tools.
 *
 * Child tools map one-to-one to official Admin REST API operations while this
 * class handles configured-state checks, argument mapping, validation, and errors.
 */
abstract class AbstractKeycloakTool implements Tool
{
    protected const OPERATION = [];

    /**
     * @param  KeycloakService  $service  Keycloak Admin REST API client.
     */
    public function __construct(protected KeycloakService $service) {}

    public function name(): string { return (string) static::OPERATION['slug']; }
    public function description(): string { return (string) static::OPERATION['description']; }
    public function parameters(): array { return static::OPERATION['parameters']; }

    /**
     * Execute the mapped Keycloak Admin REST API operation.
     *
     * @param  array<string, mixed>  $args  Tool arguments for this operation.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) { return ToolResult::error('Keycloak integration is not configured.'); }

            return ToolResult::success($this->service->executeOperation(static::OPERATION, $args));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}