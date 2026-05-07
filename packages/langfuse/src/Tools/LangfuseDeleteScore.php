<?php

namespace OpenCompany\Integrations\Langfuse\Tools;

/**
 * Delete a Langfuse score by ID.
 */
class LangfuseDeleteScore extends AbstractLangfuseTool
{
    protected const NAME = 'langfuse_delete_score';
    protected const DESCRIPTION = 'Delete a Langfuse score by ID.';
    protected const SERVICE_METHOD = 'deleteScore';
    protected const MODE = 'id';
    protected const ID_KEY = 'score_id';
    protected const PARAMETERS = [
        'score_id' => ['type' => 'string', 'required' => true, 'description' => 'Score ID to delete.'],
    ];
}
