<?php

namespace OpenCompany\Integrations\ChurnZero\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\ChurnZero\ChurnZeroService;

/**
 * Increment a numeric ChurnZero account or contact attribute.
 *
 * Uses ChurnZero incrementAttribute for counters and additive numeric fields.
 */
class ChurnZeroIncrementAttribute implements Tool
{
    /**
     * @param  ChurnZeroService  $service  The ChurnZero HTTP API client.
     */
    public function __construct(
        private ChurnZeroService $service,
    ) {}

    public function name(): string
    {
        return 'churnzero_increment_attribute';
    }

    public function description(): string
    {
        return 'Increment a numeric ChurnZero account or contact attribute. Use a negative amount to decrement.';
    }

    public function parameters(): array
    {
        return [
            'entity' => ['type' => 'string', 'required' => true, 'enum' => ['account', 'contact'], 'description' => 'Whether to increment an account or contact attribute.'],
            'account_external_id' => ['type' => 'string', 'required' => true, 'description' => 'Account identifier from your source system.'],
            'contact_external_id' => ['type' => 'string', 'description' => 'Contact identifier from your source system. Required when entity is contact.'],
            'name' => ['type' => 'string', 'required' => true, 'description' => 'Numeric attribute name configured in ChurnZero.'],
            'value' => ['type' => 'number', 'required' => true, 'description' => 'Amount to add to the current value.'],
        ];
    }

    /**
     * Increment a ChurnZero attribute.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('ChurnZero integration is not configured.');
            }

            $result = $this->service->incrementAttribute(
                (string) $args['entity'],
                (string) $args['account_external_id'],
                isset($args['contact_external_id']) ? (string) $args['contact_external_id'] : null,
                (string) $args['name'],
                (float) $args['value'],
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
