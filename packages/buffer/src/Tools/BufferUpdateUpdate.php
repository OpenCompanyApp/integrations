<?php

namespace OpenCompany\Integrations\Buffer\Tools;

/**
 * Edit an existing pending Buffer update.
 */
class BufferUpdateUpdate extends AbstractBufferTool
{
    protected const NAME = 'buffer_update_update';
    protected const DESCRIPTION = 'Edit an existing pending Buffer update.';
    protected const METHOD = 'updateUpdate';
    protected const ARGUMENTS = ['updateId'];
    protected const REQUIRED = ['updateId', 'payload'];
    protected const USE_PAYLOAD = true;
}
