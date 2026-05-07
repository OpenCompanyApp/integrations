<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Vbout\Tools;

/**
 * Settings Delete Custom Short Code tool for the VBOUT API.
 *
 * Delegates execution to the shared VBOUT operation tool base.
 */
class VboutSettingsDeleteCustomShortcode extends AbstractVboutOperationTool
{
    protected const OPERATION = 'settings_delete_custom_shortcode';
}