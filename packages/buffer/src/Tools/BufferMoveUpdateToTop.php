<?php

namespace OpenCompany\Integrations\Buffer\Tools;

/**
 * Move a pending Buffer update to the top of the queue.
 */
class BufferMoveUpdateToTop extends AbstractBufferTool
{
    protected const NAME = 'buffer_move_update_to_top';
    protected const DESCRIPTION = 'Move a pending Buffer update to the top of the queue.';
    protected const METHOD = 'moveUpdateToTop';
    protected const ARGUMENTS = ['updateId'];
    protected const REQUIRED = ['updateId'];
}
