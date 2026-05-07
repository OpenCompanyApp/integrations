<?php

namespace OpenCompany\Integrations\Revolut\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Revolut\RevolutService;

/**
 * Retrieve sensitive details for a Revolut card.
 *
 * Requires a token with READ_SENSITIVE_CARD_DATA scope and Revolut IP whitelisting.
 */
class RevolutGetSensitiveCardDetails implements Tool
{
    /**
     * @param  RevolutService  $service  The Revolut Business API client
     */
    public function __construct(
        private RevolutService $service,
    ) {}

    public function name(): string
    {
        return 'revolut_get_sensitive_card_details';
    }

    public function description(): string
    {
        return <<<'MD'
        Retrieve sensitive card details for a Revolut Business card.
        This requires Revolut's READ_SENSITIVE_CARD_DATA scope and IP whitelisting; prefer get_card unless PAN/CVV details are explicitly needed.
        MD;
    }

    public function parameters(): array
    {
        return [
            'card_id' => ['type' => 'string', 'required' => true, 'description' => 'Revolut card UUID.'],
        ];
    }

    /**
     * Retrieve sensitive details for a Revolut card.
     *
     * @param  array<string, mixed>  $args  Tool arguments (card_id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Revolut integration is not configured.');
            }

            $cardId = (string) ($args['card_id'] ?? '');
            if ($cardId === '') {
                return ToolResult::error('card_id is required.');
            }

            return ToolResult::success($this->service->getSensitiveCardDetails($cardId));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
