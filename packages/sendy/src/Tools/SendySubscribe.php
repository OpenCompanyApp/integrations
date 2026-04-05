<?php

namespace OpenCompany\Integrations\Sendy\Tools;

use OpenCompany\Integrations\Sendy\SendyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class SendySubscribe implements Tool
{
    public function __construct(
        private SendyService $service,
    ) {}

    /**
     * Get the tool name.
     */
    public function name(): string
    {
        return 'sendy_subscribe';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'Subscribe an email address to a Sendy mailing list. Optionally provide a name and custom fields.';
    }

    /**
     * Get the tool parameters schema.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'list' => ['type' => 'string', 'required' => true, 'description' => 'The list ID to subscribe to.'],
            'email' => ['type' => 'string', 'required' => true, 'description' => 'The subscriber\'s email address.'],
            'name' => ['type' => 'string', 'description' => 'The subscriber\'s name (optional).'],
        ];
    }

    /**
     * Execute the subscribe tool.
     *
     * @param  array<string, mixed>  $args
     * @return ToolResult
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Sendy integration is not configured.');
            }

            $list = $args['list'];
            $email = $args['email'];
            $name = $args['name'] ?? null;

            $result = $this->service->subscribe($list, $email, $name);

            if ($result['status'] === 'success') {
                return ToolResult::success([
                    'list' => $list,
                    'email' => $email,
                    'message' => $result['message'],
                ]);
            }

            return ToolResult::error($result['message']);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
