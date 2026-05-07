<?php

namespace OpenCompany\Integrations\WorldBank\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\WorldBank\WorldBankService;

/**
 * Fetch detailed metadata for a World Bank indicator.
 */
class WorldBankIndicatorInfo implements Tool
{
    /**
     * @param  WorldBankService  $service  The World Bank API client.
     */
    public function __construct(private WorldBankService $service) {}

    public function name(): string
    {
        return 'worldbank_indicator_info';
    }

    public function description(): string
    {
        return 'Get metadata for a World Bank indicator code, including source, source note, source organization, and topics.';
    }

    public function parameters(): array
    {
        return [
            'indicator' => ['type' => 'string', 'required' => true, 'description' => 'World Bank indicator code, such as NY.GDP.MKTP.CD.'],
        ];
    }

    /**
     * Fetch indicator metadata.
     *
     * @param  array<string, mixed>  $args  Tool arguments (indicator).
     */
    public function execute(array $args): ToolResult
    {
        try {
            $indicator = $args['indicator'] ?? null;
            if (! $indicator) {
                return ToolResult::error('indicator is required.');
            }

            $result = $this->service->getIndicator((string) $indicator);
            $item = $result['data'][0] ?? null;

            if (! is_array($item)) {
                return ToolResult::error("No indicator found for code: {$indicator}");
            }

            return ToolResult::success([
                'code' => $item['id'] ?? null,
                'name' => $item['name'] ?? null,
                'unit' => $item['unit'] ?? null,
                'source' => $item['source']['value'] ?? null,
                'source_id' => $item['source']['id'] ?? null,
                'source_note' => $item['sourceNote'] ?? null,
                'source_organization' => $item['sourceOrganization'] ?? null,
                'topics' => $item['topics'] ?? [],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
