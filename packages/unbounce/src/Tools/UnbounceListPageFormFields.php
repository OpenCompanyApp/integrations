<?php

namespace OpenCompany\Integrations\Unbounce\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List form fields for an Unbounce page.
 */
class UnbounceListPageFormFields extends AbstractUnbounceTool
{
    public function name(): string { return 'unbounce_list_page_form_fields'; }

    public function description(): string { return 'List form fields for an Unbounce page.'; }

    public function parameters(): array { return ['page_id' => ['type' => 'string', 'required' => true, 'description' => 'Page ID.']]; }

    /**
     * List page form fields.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->listPageFormFields($this->requiredString($args, 'page_id')));
    }
}
