<?php

namespace OpenCompany\Integrations\Wufoo\Tools;

/**
 * Count comments made on Wufoo form entries.
 */
class WufooCountFormComments extends AbstractWufooTool
{
    public const NAME = 'wufoo_count_form_comments';
    public const DESCRIPTION = 'Count comments made on entries for a Wufoo form.';
    public const PARAMETERS = [
        'form_id' => ['type' => 'string', 'required' => true, 'description' => 'The form hash or title identifier.'],
        'params' => ['type' => 'object', 'description' => 'Optional query parameters such as pretty.'],
    ];

    /**
     * Count form comments.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->countFormComments(
            $this->requiredString($args, 'form_id', 'form_id'),
            $this->arrayArg($args, 'params'),
        );
    }
}
