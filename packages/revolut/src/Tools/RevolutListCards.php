<?php

namespace OpenCompany\Integrations\Revolut\Tools;

use OpenCompany\Integrations\Revolut\RevolutService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List all Revolut business cards.
 *
 * Returns card IDs, last 4 digits, status, and cardholder information.
 */
class RevolutListCards implements Tool
{
    /**
     * @param  RevolutService  $service  The Revolut API client
     */
    public function __construct(
        private RevolutService $service,
    ) {}

    public function name(): string
    {
        return 'revolut_list_cards';
    }

    public function description(): string
    {
        return <<<'MD'
        List all Revolut business cards.
        Returns card IDs, last 4 digits, status, and cardholder information.
        MD;
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * List all Revolut business cards.
     *
     * @param  array<string, mixed>  $args  Tool arguments (none)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Revolut integration is not configured.');
            }

            $result = $this->service->listCards();

            $cards = array_map(function (array $c) {
                return [
                    'id' => $c['id'] ?? '',
                    'last_four_digits' => $c['last_four_digits'] ?? '',
                    'status' => $c['status'] ?? '',
                    'cardholder_name' => $c['cardholder_name'] ?? '',
                    'currency' => $c['currency'] ?? '',
                    'type' => $c['type'] ?? '',
                    'label' => $c['label'] ?? null,
                    'expiry_date' => $c['expiry_date'] ?? null,
                ];
            }, is_array($result) ? $result : []);

            return ToolResult::success([
                'cards' => $cards,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
