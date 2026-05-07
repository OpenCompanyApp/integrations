<?php

namespace OpenCompany\Integrations\Beehiiv\Tools;

/**
 * Recalculate segment OAuth Scope: segments:write.
 *
 * Executes the official beehiiv API operation segments_recalculate.
 */
class BeehiivSegmentsRecalculate extends AbstractBeehiivOperationTool
{
    protected const OPERATION = 'beehiiv_segments_recalculate';
}
