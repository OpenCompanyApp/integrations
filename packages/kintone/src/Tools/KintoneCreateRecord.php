<?php

namespace OpenCompany\Integrations\Kintone\Tools;

use OpenCompany\Integrations\Kintone\KintoneService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class KintoneCreateRecord implements Tool
{
    public function __construct(
        private KintoneService $service,
    ) {}

    public function name(): string
    {
        return 'kintone_create_record';
    }

    public function description(): string
    {
        return 'Create a new record in a Kintone app. The record parameter is an object keyed by field codes, each containing a "value" property (e.g., {"Title": {"value": "Hello"}, "Number": {"value": 42}}).';
    }

    public function parameters(): array
    {
        return [
            'app' => ['type' => 'integer', 'required' => true, 'description' => 'The app ID.'],
            'record' => ['type' => 'object', 'required' => true, 'description' => 'Field values keyed by field code. Each key maps to {"value": ...}. Example: {"Title": {"value": "Hello"}, "Number": {"value": 42}}.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Kintone integration is not configured.');
            }

            $record = $args['record'];

            if (!is_array($record)) {
                return ToolResult::error('The "record" parameter must be an object with field codes as keys.');
            }

            $result = $this->service->createRecord(
                app: (int) $args['app'],
                record: $record,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
