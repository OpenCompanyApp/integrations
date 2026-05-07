<?php

namespace OpenCompany\Integrations\ZohoMail\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a Zoho Mail folder.
 */
class ZohoMailCreateFolder extends AbstractZohoMailTool
{
    public function name(): string { return 'zohomail_create_folder'; }

    public function description(): string { return 'Create a Zoho Mail folder.'; }

    public function parameters(): array { return ['accountId' => ['type' => 'string', 'required' => true, 'description' => 'Account ID.'], 'payload' => ['type' => 'object', 'required' => true, 'description' => 'Folder creation payload.']]; }

    /**
     * Create a folder.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->createFolder($this->requiredString($args, 'accountId'), $this->arrayArg($args, 'payload')));
    }
}
