<?php

namespace OpenCompany\Integrations\Fathom\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Fathom\FathomService;

/**
 * Create a Fathom event.
 */
class FathomCreateEvent implements Tool
{
    /**
     * @param  FathomService  $service  The Fathom API client.
     */
    public function __construct(private FathomService $service) {}

    public function name(): string
    {
        return 'fathom_create_event';
    }

    public function description(): string
    {
        return 'Create a Fathom event for a site.';
    }

    public function parameters(): array
    {
        return [
            'site_id' => ['type' => 'string', 'required' => true, 'description' => 'Fathom site ID.'],
            'name' => ['type' => 'string', 'required' => true, 'description' => 'Event name.'],
        ];
    }

    /**
     * Create an event.
     *
     * @param  array<string, mixed>  $args  Tool arguments (site_id, name).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Fathom integration is not configured.');
            }
            if (empty($args['site_id']) || empty($args['name'])) {
                return ToolResult::error('site_id and name are required.');
            }

            return ToolResult::success($this->service->createEvent((string) $args['site_id'], (string) $args['name']));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
