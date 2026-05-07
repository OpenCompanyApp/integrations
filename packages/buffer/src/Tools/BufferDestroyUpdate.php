<?php

namespace OpenCompany\Integrations\Buffer\Tools;

/**
 * Permanently delete a pending Buffer update.
 */
class BufferDestroyUpdate extends AbstractBufferTool
{
    protected const NAME = 'buffer_destroy_update';
    protected const DESCRIPTION = 'Permanently delete a pending Buffer update.';
    protected const METHOD = 'destroyUpdate';
    protected const ARGUMENTS = ['updateId'];
    protected const REQUIRED = ['updateId'];
}
