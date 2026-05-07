<?php

namespace OpenCompany\Integrations\Miniflux\Tools;

/**
 * Flush removed entry history.
 */
class MinifluxFlushHistory extends AbstractMinifluxTool
{
    protected const OPERATION = 'flush_history';
}
