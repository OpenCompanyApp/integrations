<?php

namespace OpenCompany\Integrations\KoFi\Tools;

use OpenCompany\Integrations\KoFi\KoFiService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class KoFiGetSupporter implements Tool
{
    public function __construct(
        private KoFiService $service,
    ) {}

    public function name(): string
    {
        return 'ko-fi_get_supporter';
    }

    public function description(): string
    {
        return 'Get detailed information about a single Ko-fi supporter by their email address. Returns full supporter profile including contribution history and status.';
    }

    public function parameters(): array
    {
        return [
            'email' => ['type' => 'string', 'required' => true, 'description' => 'The email address of the supporter to retrieve.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Ko-fi integration is not configured.');
            }

            if (empty($args['email'])) {
                return ToolResult::error('email is required.');
            }

            $result = $this->service->getSupporter($args['email']);

            $supporter = $result['supporter'] ?? $result;

            return ToolResult::success($supporter);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
