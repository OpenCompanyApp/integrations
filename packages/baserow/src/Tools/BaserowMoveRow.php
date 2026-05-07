<?php

namespace OpenCompany\Integrations\Baserow\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Move a Baserow row before another row or to the end of a table.
 */
class BaserowMoveRow extends AbstractBaserowTool
{
    public function name(): string
    {
        return 'baserow_move_row';
    }

    public function description(): string
    {
        return 'Move a Baserow row before another row or to the end of a table.';
    }

    public function parameters(): array
    {
        return [
            'table_id' => ['type' => 'integer', 'required' => true, 'description' => 'The Baserow table ID.'],
            'row_id' => ['type' => 'integer', 'required' => true, 'description' => 'The row ID to move.'],
            'before_id' => ['type' => 'integer', 'description' => 'Optional row ID to move this row before. Omit to move to the end.'],
        ];
    }

    /**
     * Move a Baserow row.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(function () use ($args): array {
            $query = [];
            if (isset($args['before_id']) && $args['before_id'] !== '') {
                $query['before_id'] = (int) $args['before_id'];
            }

            return $this->service->moveRow(
                $this->requiredInt($args, 'table_id'),
                $this->requiredInt($args, 'row_id'),
                $query
            );
        });
    }
}
