<?php

namespace OpenCompany\Integrations\Square\Tools;

use OpenCompany\Integrations\Square\SquareService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class SquareGetPayment implements Tool
{
    /**
     * Create a new SquareGetPayment tool instance.
     */
    public function __construct(
        private SquareService $service,
    ) {}

    /**
     * Get the tool name.
     */
    public function name(): string
    {
        return 'square_get_payment';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'Get details of a specific Square payment by its ID, including amount, status, and card info.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The Square payment ID to retrieve.'],
        ];
    }

    /**
     * Execute the tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Square integration is not configured.');
            }

            $id = $args['id'] ?? '';

            if (empty($id)) {
                return ToolResult::error('Payment ID is required.');
            }

            $result = $this->service->getPayment($id);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
