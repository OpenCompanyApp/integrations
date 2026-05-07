<?php

namespace OpenCompany\Integrations\Beehiiv\Tools;

/**
 * Delete segment OAuth Scope: segments:write.
 *
 * Executes the official beehiiv API operation segments_delete.
 */
class BeehiivSegmentsDelete extends AbstractBeehiivOperationTool
{
    protected const OPERATION = 'beehiiv_segments_delete';
}
