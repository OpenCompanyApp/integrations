<?php

namespace OpenCompany\Integrations\WorldBank\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\WorldBank\WorldBankService;

/**
 * List languages supported by the World Bank API.
 */
class WorldBankLanguages implements Tool
{
    /**
     * @param  WorldBankService  $service  The World Bank API client.
     */
    public function __construct(private WorldBankService $service) {}

    public function name(): string
    {
        return 'worldbank_languages';
    }

    public function description(): string
    {
        return 'List global and local language codes supported by the World Bank API v2.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * List supported languages.
     *
     * @param  array<string, mixed>  $args  Tool arguments; none are required.
     */
    public function execute(array $args): ToolResult
    {
        try {
            $result = $this->service->getLanguages();

            return ToolResult::success([
                'languages' => array_map(static fn (array $language): array => [
                    'code' => $language['code'] ?? null,
                    'name' => isset($language['name']) ? trim((string) $language['name']) : null,
                    'native_form' => isset($language['nativeForm']) ? trim((string) $language['nativeForm']) : null,
                ], $result['data']),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
