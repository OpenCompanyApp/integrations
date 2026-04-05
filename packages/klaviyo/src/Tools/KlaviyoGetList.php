<?php

namespace OpenCompany\Integrations\Klaviyo\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Klaviyo\KlaviyoService;

/**
 * Get a single Klaviyo list by ID.
 */
class KlaviyoGetList implements Tool
{
    /** @param KlaviyoService $service The Klaviyo API client */
    public function __construct(
        private KlaviyoService $service,
    ) {}

    public function name(): string
    {
        return 'klaviyo_get_list';
    }

    public function description(): string
    {
        return <<<'MD'
        Retrieve a single Klaviyo list by its ID.
        Returns the list's name, member count, and other metadata.
        MD;
    }

    public function parameters(): array
    {
        return [
            'list_id' => [
                'type' => 'string',
                'required' => true,
                'description' => 'The Klaviyo list ID.',
            ],
        ];
    }

    /** @param array<string, mixed> $args Tool arguments */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Klaviyo integration is not configured.');
            }

            $listId = $args['list_id'] ?? '';
            if (empty($listId)) {
                return ToolResult::error('The "list_id" parameter is required.');
            }

            $result = $this->service->getList($listId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
