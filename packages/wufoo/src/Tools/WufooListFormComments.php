<?php

namespace OpenCompany\Integrations\Wufoo\Tools;

/**
 * List comments made on Wufoo form entries.
 */
class WufooListFormComments extends AbstractWufooTool
{
    public const NAME = 'wufoo_list_form_comments';
    public const DESCRIPTION = 'List comments made on entries for a Wufoo form, optionally filtered by entry ID and paginated.';
    public const PARAMETERS = [
        'form_id' => ['type' => 'string', 'required' => true, 'description' => 'The form hash or title identifier.'],
        'params' => ['type' => 'object', 'description' => 'Optional query parameters such as entryId, pageStart, pageSize, or pretty.'],
    ];

    /**
     * List form comments.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->listFormComments(
            $this->requiredString($args, 'form_id', 'form_id'),
            $this->arrayArg($args, 'params'),
        );
    }
}
