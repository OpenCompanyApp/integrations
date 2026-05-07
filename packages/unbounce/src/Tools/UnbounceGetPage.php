<?php

namespace OpenCompany\Integrations\Unbounce\Tools;

use OpenCompany\Integrations\Unbounce\UnbounceService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get an Unbounce landing page by ID.
 */
class UnbounceGetPage implements Tool
{
    /**
     * @param  UnbounceService  $service  Unbounce API client.
     */
    public function __construct(
        private UnbounceService $service,
    ) {}

    public function name(): string
    {
        return 'unbounce_get_page';
    }

    public function description(): string
    {
        return 'Get details of a specific Unbounce landing page by its ID. Returns the page name, URL, variants, conversion rates, and other metadata.';
    }

    public function parameters(): array
    {
        return [
            'page_id' => ['type' => 'string', 'required' => true, 'description' => 'The Unbounce page ID (e.g., "a2834fde-1234-5678-abcd-1234567890ab").'],
        ];
    }

    /**
     * Get a page.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Unbounce integration is not configured.');
            }

            if (empty($args['page_id'])) {
                return ToolResult::error('page_id is required.');
            }

            $result = $this->service->getPage($args['page_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
