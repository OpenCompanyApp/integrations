<?php

namespace OpenCompany\Integrations\AmazonSes\Tools;

/**
 * Delete an Amazon SES email template.
 */
class AmazonSesDeleteTemplate extends AbstractAmazonSesTool
{
    public function name(): string { return 'amazonses_delete_template'; }

    public function description(): string { return 'Delete an Amazon SES email template by name.'; }

    public function parameters(): array
    {
        return [
            'template_name' => ['type' => 'string', 'required' => true, 'description' => 'Template name.'],
        ];
    }

    /** @param  array<string, mixed>  $args  Tool arguments. */
    protected function callService(array $args): array
    {
        return $this->service->deleteTemplate($this->stringArg($args, 'template_name'));
    }
}
