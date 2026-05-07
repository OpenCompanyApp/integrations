<?php

namespace OpenCompany\Integrations\ZohoMail\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a Zoho Mail label.
 */
class ZohoMailCreateLabel extends AbstractZohoMailTool
{
    public function name(): string { return 'zohomail_create_label'; }

    public function description(): string { return 'Create a Zoho Mail label.'; }

    public function parameters(): array { return ['accountId' => ['type' => 'string', 'required' => true, 'description' => 'Account ID.'], 'payload' => ['type' => 'object', 'required' => true, 'description' => 'Label creation payload.']]; }

    /**
     * Create a label.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->createLabel($this->requiredString($args, 'accountId'), $this->arrayArg($args, 'payload')));
    }
}
