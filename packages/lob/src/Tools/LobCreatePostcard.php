<?php

namespace OpenCompany\Integrations\Lob\Tools;

use OpenCompany\Integrations\Lob\LobService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class LobCreatePostcard implements Tool
{
    public function __construct(
        private LobService $service,
    ) {}

    public function name(): string
    {
        return 'lob_create_postcard';
    }

    public function description(): string
    {
        return 'Create and send a postcard via Lob. Provide recipient and sender addresses (as address IDs or inline address objects), plus HTML or template IDs for the front and back.';
    }

    public function parameters(): array
    {
        return [
            'to' => ['type' => 'string', 'required' => true, 'description' => 'Recipient — an address ID (e.g., "adr_...") or an inline address object (name, address_line1, city, state, zip).'],
            'from' => ['type' => 'string', 'description' => 'Sender — an address ID or inline address object. Optional if a default return address is configured.'],
            'description' => ['type' => 'string', 'description' => 'An internal description for the postcard (not printed on the postcard itself).'],
            'front' => ['type' => 'string', 'required' => true, 'description' => 'HTML string or template ID for the front of the postcard (e.g., "<html>...</html>" or "tmpl_...").'],
            'back' => ['type' => 'string', 'required' => true, 'description' => 'HTML string or template ID for the back of the postcard.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Lob integration is not configured.');
            }

            $to = $args['to'];
            $from = $args['from'] ?? null;
            $description = $args['description'] ?? null;
            $front = $args['front'];
            $back = $args['back'];

            $result = $this->service->createPostcard($to, $from, $front, $back, $description);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
