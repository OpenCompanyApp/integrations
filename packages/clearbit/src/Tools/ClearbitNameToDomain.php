<?php

namespace OpenCompany\Integrations\Clearbit\Tools;

/**
 * Resolve a company name to a domain and logo with Clearbit's legacy API.
 */
class ClearbitNameToDomain extends AbstractClearbitTool
{
    public function name(): string
    {
        return 'clearbit_name_to_domain';
    }

    public function description(): string
    {
        return 'Find a company domain and logo by company name using Clearbit Name to Domain. This is a legacy unsupported API for existing Clearbit customers.';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'Company name, such as Segment.'],
        ];
    }

    protected function callService(array $args): array
    {
        return $this->service->nameToDomain($this->stringArg($args, 'name'));
    }
}
