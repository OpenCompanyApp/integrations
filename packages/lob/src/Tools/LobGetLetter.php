<?php

namespace OpenCompany\Integrations\Lob\Tools;

use OpenCompany\Integrations\Lob\LobService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class LobGetLetter implements Tool
{
    public function __construct(
        private LobService $service,
    ) {}

    public function name(): string
    {
        return 'lob_get_letter';
    }

    public function description(): string
    {
        return 'Retrieve details of a specific letter by its Lob ID, including delivery status, tracking info, and the letter URL.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The letter ID (e.g., "ltr_abcdef123456").'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Lob integration is not configured.');
            }

            $id = $args['id'];
            $result = $this->service->getLetter($id);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
