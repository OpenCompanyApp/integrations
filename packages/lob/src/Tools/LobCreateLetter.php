<?php

namespace OpenCompany\Integrations\Lob\Tools;

use OpenCompany\Integrations\Lob\LobService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class LobCreateLetter implements Tool
{
    public function __construct(
        private LobService $service,
    ) {}

    public function name(): string
    {
        return 'lob_create_letter';
    }

    public function description(): string
    {
        return 'Create and send a letter via Lob. Provide recipient and sender addresses (as address IDs or inline address objects), plus an HTML file or template ID for the letter content.';
    }

    public function parameters(): array
    {
        return [
            'to' => ['type' => 'string', 'required' => true, 'description' => 'Recipient — an address ID (e.g., "adr_...") or an inline address object.'],
            'from' => ['type' => 'string', 'description' => 'Sender — an address ID or inline address object. Optional if a default return address is configured.'],
            'description' => ['type' => 'string', 'description' => 'An internal description for the letter (not printed on the letter itself).'],
            'file' => ['type' => 'string', 'required' => true, 'description' => 'HTML string or template ID for the letter content (e.g., "<html>...</html>" or "tmpl_...").'],
            'color' => ['type' => 'boolean', 'description' => 'Print in color (default: true). Set to false for black & white.'],
            'double_sided' => ['type' => 'boolean', 'description' => 'Print double-sided (default: true). Set to false for single-sided.'],
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
            $file = $args['file'];
            $color = $args['color'] ?? true;
            $doubleSided = $args['double_sided'] ?? true;

            $result = $this->service->createLetter($to, $from, $file, $description, $color, $doubleSided);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
