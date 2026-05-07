<?php

namespace OpenCompany\Integrations\Buffer\Tools;

/**
 * Immediately share a pending Buffer update.
 */
class BufferShareUpdate extends AbstractBufferTool
{
    protected const NAME = 'buffer_share_update';
    protected const DESCRIPTION = 'Immediately share a pending Buffer update and recalculate the remaining queue.';
    protected const METHOD = 'shareUpdate';
    protected const ARGUMENTS = ['updateId'];
    protected const REQUIRED = ['updateId'];
}
