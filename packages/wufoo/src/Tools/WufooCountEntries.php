<?php

namespace OpenCompany\Integrations\Wufoo\Tools;

/**
 * Count entries for a Wufoo form with optional filters.
 */
class WufooCountEntries extends AbstractWufooTool
{
    public const NAME = 'wufoo_count_entries';
    public const DESCRIPTION = 'Count entries submitted to a Wufoo form. Accepts the same filter query parameters as the entries endpoint.';
    public const PARAMETERS = [
        'form_id' => ['type' => 'string', 'required' => true, 'description' => 'The form hash or title identifier.'],
        'params' => ['type' => 'object', 'description' => 'Optional query parameters such as Filter1, Match, or pretty.'],
    ];

    /**
     * Count form entries.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->countEntries(
            $this->requiredString($args, 'form_id', 'form_id'),
            $this->arrayArg($args, 'params'),
        );
    }
}
