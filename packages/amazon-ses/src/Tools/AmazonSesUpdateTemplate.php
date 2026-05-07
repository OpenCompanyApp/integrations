<?php

namespace OpenCompany\Integrations\AmazonSes\Tools;

/**
 * Update an Amazon SES email template.
 */
class AmazonSesUpdateTemplate extends AbstractAmazonSesTool
{
    public function name(): string { return 'amazonses_update_template'; }

    public function description(): string { return 'Update an existing Amazon SES email template.'; }

    public function parameters(): array
    {
        return [
            'template_name' => ['type' => 'string', 'required' => true, 'description' => 'Template name.'],
            'subject' => ['type' => 'string', 'required' => true, 'description' => 'Template subject.'],
            'html_content' => ['type' => 'string', 'description' => 'HTML template body.'],
            'text_content' => ['type' => 'string', 'description' => 'Text template body.'],
        ];
    }

    /** @param  array<string, mixed>  $args  Tool arguments. */
    protected function callService(array $args): array
    {
        $body = ['TemplateContent' => ['Subject' => $this->stringArg($args, 'subject')]];
        if (isset($args['html_content'])) $body['TemplateContent']['Html'] = $args['html_content'];
        if (isset($args['text_content'])) $body['TemplateContent']['Text'] = $args['text_content'];

        return $this->service->updateTemplate($this->stringArg($args, 'template_name'), $body);
    }
}
