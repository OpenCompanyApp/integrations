<?php

namespace OpenCompany\Integrations\Kintone\Tools;

use OpenCompany\Integrations\Kintone\KintoneService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class KintoneGetRecord implements Tool
{
    public function __construct(
        private KintoneService $service,
    ) {}

    public function name(): string
    {
        return 'kintone_get_record';
    }

    public function description(): string
    {
        return 'Retrieve a single record from a Kintone app by its record ID. Returns all field values for the record.';
    }

    public function parameters(): array
    {
        return [
            'app' => ['type' => 'integer', 'required' => true, 'description' => 'The app ID.'],
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'The record ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Kintone integration is not configured.');
            }

            $result = $this->service->getRecord(
                app: (int) $args['app'],
                id: (int) $args['id'],
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
