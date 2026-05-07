<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Vbout\Tools;

/**
 * Pipeline Create Board From Guide tool for the VBOUT API.
 *
 * Delegates execution to the shared VBOUT operation tool base.
 */
class VboutPipelineCreateBoardFromGuide extends AbstractVboutOperationTool
{
    protected const OPERATION = 'pipeline_create_board_from_guide';
}