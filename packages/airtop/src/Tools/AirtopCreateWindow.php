<?php

namespace OpenCompany\Integrations\Airtop\Tools;

use OpenCompany\Integrations\Airtop\AirtopService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class AirtopCreateWindow implements Tool
{
    public function __construct(
        private AirtopService $service,
    ) {}

    public function name(): string
    {
        return 'airtop_create_window';
    }

    public function description(): string
    {
        return 'Open a new browser window within an existing Airtop session. Optionally specify a starting URL to navigate to immediately.';
    }

    public function parameters(): array
    {
        return [
            'session_id' => ['type' => 'string', 'required' => true, 'description' => 'The session ID to create the window in.'],
            'url' => ['type' => 'string', 'description' => 'Optional starting URL to navigate to when the window opens.'],
            'width' => ['type' => 'integer', 'description' => 'Window width in pixels (default: 1280).'],
            'height' => ['type' => 'integer', 'description' => 'Window height in pixels (default: 720).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Airtop integration is not configured.');
            }

            $options = [];
            if (isset($args['url'])) {
                $options['url'] = $args['url'];
            }
            if (isset($args['width'])) {
                $options['width'] = (int) $args['width'];
            }
            if (isset($args['height'])) {
                $options['height'] = (int) $args['height'];
            }

            $result = $this->service->createWindow($args['session_id'], $options);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
