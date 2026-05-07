<?php

namespace OpenCompany\Integrations\Supabase\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Supabase\SupabaseService;

/**
 * Create a Supabase project in an organization.
 *
 * Requires the project name, database password, and organization slug accepted
 * by the Supabase Management API.
 */
class SupabaseCreateProject implements Tool
{
    /**
     * @param  SupabaseService  $service  The Supabase Management API client.
     */
    public function __construct(
        private SupabaseService $service,
    ) {}

    public function name(): string
    {
        return 'supabase_create_project';
    }

    public function description(): string
    {
        return 'Create a Supabase project in an organization using the Management API.';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'Project name.'],
            'db_pass' => ['type' => 'string', 'required' => true, 'description' => 'Initial database password for the project.'],
            'organization_slug' => ['type' => 'string', 'required' => true, 'description' => 'Organization slug that owns the project.'],
            'region' => ['type' => 'string', 'description' => 'Optional legacy region value accepted by Supabase.'],
            'desired_instance_size' => ['type' => 'string', 'description' => 'Optional compute size accepted by Supabase.'],
            'body' => ['type' => 'object', 'description' => 'Optional full request body. Overrides individual fields when present.'],
        ];
    }

    /**
     * Create a project and return the Supabase response.
     *
     * @param  array<string, mixed>  $args  Tool arguments (name, db_pass, organization_slug, region, desired_instance_size, body)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Supabase integration is not configured.');
            }

            $body = $args['body'] ?? null;
            if ($body !== null && !is_array($body)) {
                return ToolResult::error('body must be an object.');
            }

            $payload = $body ?? array_filter([
                'name' => $args['name'] ?? null,
                'db_pass' => $args['db_pass'] ?? null,
                'organization_slug' => $args['organization_slug'] ?? null,
                'region' => $args['region'] ?? null,
                'desired_instance_size' => $args['desired_instance_size'] ?? null,
            ], static fn (mixed $value): bool => $value !== null && $value !== '');

            foreach (['name', 'db_pass', 'organization_slug'] as $required) {
                if (empty($payload[$required])) {
                    return ToolResult::error("{$required} is required.");
                }
            }

            return ToolResult::success($this->service->createProject($payload));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
