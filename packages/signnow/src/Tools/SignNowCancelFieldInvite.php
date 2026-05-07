<?php

namespace OpenCompany\Integrations\SignNow\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Cancel field invites for a SignNow document.
 */
class SignNowCancelFieldInvite extends AbstractSignNowTool implements Tool
{
    public function name(): string
    {
        return 'signnow_cancel_field_invite';
    }

    public function description(): string
    {
        return 'Cancel active field invite signing sessions for a SignNow document.';
    }

    public function parameters(): array
    {
        return [
            'document_id' => ['type' => 'string', 'required' => true, 'description' => 'Document ID.'],
        ];
    }

    /**
     * Cancel field invites.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if ($error = $this->requireConfigured()) {
                return $error;
            }
            if (empty($args['document_id'])) {
                return ToolResult::error('document_id is required.');
            }

            return ToolResult::success($this->service->cancelFieldInvite((string) $args['document_id']));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
