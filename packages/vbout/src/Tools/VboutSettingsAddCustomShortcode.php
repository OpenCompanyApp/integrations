<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Vbout\Tools;

/**
 * Settings Add Custom Short Code tool for the VBOUT API.
 *
 * Delegates execution to the shared VBOUT operation tool base.
 */
class VboutSettingsAddCustomShortcode extends AbstractVboutOperationTool
{
    protected const OPERATION = 'settings_add_custom_shortcode';
}