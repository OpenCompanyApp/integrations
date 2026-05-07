<?php

namespace OpenCompany\Integrations\Droplr\Tools;

/**
 * Create a note drop in Droplr.
 */
class DroplrCreateNote extends AbstractDroplrTool
{
    public const NAME = 'droplr_create_note';
    public const DESCRIPTION = 'Create a Droplr note drop.';
    public const PARAMETERS = [
        'content' => ['type' => 'string', 'required' => true, 'description' => 'Note content.'],
        'title' => ['type' => 'string', 'description' => 'Optional note title.'],
        'variant' => ['type' => 'string', 'description' => 'Optional note variant such as plain or code.'],
        'extra' => ['type' => 'object', 'description' => 'Additional Droplr-supported fields such as privacy or password.'],
    ];

    /**
     * Create a note drop.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->createNoteDrop(
            $this->requiredString($args, 'content', 'content'),
            isset($args['title']) ? (string) $args['title'] : null,
            isset($args['variant']) ? (string) $args['variant'] : null,
            $this->arrayArg($args, 'extra')
        );
    }
}
