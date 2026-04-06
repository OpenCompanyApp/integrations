<?php

namespace OpenCompany\Integrations\Vbout\Tools;

use OpenCompany\Integrations\Vbout\VboutService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class VboutListContacts implements Tool
{
    public function __construct(
        private VboutService $service,
    ) {}

    public function name(): string
    {
        return 'vbout_list_contacts';
    }

    public function description(): string
    {
        return 'List contacts from VBout. Returns paginated contact records including email, name, and list membership.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of contacts to return (default: 20, max: 100).'],
            'offset' => ['type' => 'integer', 'description' => 'Offset for pagination (default: 0).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('VBout integration is not configured.');
            }

            $limit = min(isset($args['limit']) ? (int) $args['limit'] : 20, 100);
            $offset = isset($args['offset']) ? (int) $args['offset'] : 0;

            $result = $this->service->listContacts($limit, $offset);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
